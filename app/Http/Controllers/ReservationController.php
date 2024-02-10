<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Reservation;
use App\Models\Car;
use Illuminate\Http\Request;
use PDF;
use Mail;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'pickup_location' => 'required|in:airport,agency,other_city',
            'start_date' => 'required|date',
            'car_id' => 'required|exists:cars,id',
            'end_date' => 'required|date|after_or_equal:start_date',
        ], [
            'end_date.after_or_equal' => 'La date de fin doit être après ou égale à la date de début.',
        ]);

        if (!$this->isCarAvailable($validated['car_id'], $validated['start_date'], $validated['end_date'])) {
            return back()->with('error', 'Ce véhicule n\'est pas disponible pour les dates sélectionnées.');
        }

        $car = Car::find($validated['car_id']);
        if (!$car) {
            return back()->with('error', 'La voiture sélectionnée est invalide.');
        }

        $pricePerDayShortTerm = $car->price_per_day_short_term; // 350 DH
        $pricePerDayLongTerm = $car->price_per_day_long_term; // 300 DH

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $totalDays = $endDate->diffInDays($startDate) + 1;

        if ($totalDays <= 3) {
            $totalCost = $totalDays * $pricePerDayShortTerm;
        } else {
            $totalCost = $totalDays * $pricePerDayLongTerm;
        }

        $validated['total_cost'] = $totalCost;
        $reservation = Reservation::create($validated);

        if ($reservation) {
            return back()->with('success', "Votre réservation a été effectuée avec succès ! Le coût total est de $totalCost DH.");
        } else {
            return back()->with('error', 'Une erreur est survenue lors de la création de votre réservation.');
        }
    }

    private function isCarAvailable($carId, $startDate, $endDate)
    {
        $overlappingReservations = Reservation::where('car_id', $carId)
            ->where('status', 'accepted')
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '<', $startDate)
                            ->where('end_date', '>', $endDate);
                    });
            })
            ->count();

        return $overlappingReservations === 0;
    }



    public function accept($id)
    {
        $reservation = Reservation::findOrFail($id);
        if ($this->isCarAvailable($reservation->car_id, $reservation->start_date, $reservation->end_date)) {
            $reservation->status = 'accepted';
            $reservation->save();

            $this->updateCarAvailabilityOnReservation($reservation->car_id, false);

            $pdfFR = PDF::loadView('emails.reservation.FRconfirmation', ['reservation' => $reservation]);
            $pdfEN = PDF::loadView('emails.reservation.ENconfirmation', ['reservation' => $reservation]);

            Mail::send('emails.reservation.confirmation', ['reservation' => $reservation], function ($message) use ($pdfFR, $pdfEN, $reservation) {
                $message->to($reservation->email)
                    ->subject('Confirmation de Réservation')
                    ->attachData($pdfFR->output(), "fr.confirmation_reservation.pdf")
                    ->attachData($pdfEN->output(), "en.confirmation_reservation.pdf");
            });

            return redirect()->route('dashboard')->with('success', 'La réservation a été acceptée avec succès et l\'email a été envoyé.');
        } else {
            return back()->withErrors(['error' => 'La voiture n\'est plus disponible pour les dates sélectionnées.']);
        }
    }

    private function updateCarAvailabilityOnReservation($carId, $available)
    {
        Car::where('id', $carId)->update(['disponible' => $available ? 1 : 0]);
    }


    public function isAvailableToday()
    {
        $today = now()->format('Y-m-d');
        return $this->reservations()
            ->where('status', 'accepted')
            ->where(function ($query) use ($today) {
                $query->where('start_date', '<=', $today)
                    ->where('end_date', '>=', $today);
            })->count() == 0;
    }


    public function reject($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('dashboard')->with('success', 'Réservation supprimée avec succès.');
    }




    public function dashboard()
    {
        $reservations = Reservation::where('status', 'pending')->get();
        $reservations = Reservation::with('car')->get();
        return view('dashboard', compact('reservations'));
    }


    public function create($carId)
    {
        $car = Car::find($carId);
        if (!$car) {
            return redirect()->route('home')->with('error', 'Voiture non trouvée.');
        }
        $model_name = $car->model_name;
        $unavailableDates = Reservation::where('car_id', $carId)
            ->where('status', 'accepted')
            ->get(['start_date', 'end_date']);

        $futureUnavailableDates = $this->getUnavailableDatesForCar($carId);

        return view('reservation.create', compact('carId', 'car', 'unavailableDates', 'futureUnavailableDates'));


    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $email = $reservation->email;
        $firstName = $reservation->first_name;


        Mail::send('emails.reservation_canceled', ['firstName' => $firstName, 'reservation' => $reservation], function ($message) use ($email) {
            $message->to($email)->subject('Annulation de votre réservation');
        });



        $reservation->delete();

        return back()->with('success', 'La réservation a été annulée avec succès.');
    }

    public function getUnavailableDatesForCar($carId)
    {
        $now = Carbon::now()->startOfDay();
        $reservations = Reservation::where('car_id', $carId)
            ->where('status', 'accepted')
            ->get();

        $dates = collect();

        foreach ($reservations as $reservation) {
            $startDate = Carbon::parse($reservation->start_date);
            $endDate = Carbon::parse($reservation->end_date);
            if ($endDate->gte($now)) {

                $key = $startDate->format('Y-m-d') . '_' . $endDate->format('Y-m-d');
                if (!$dates->has($key)) {
                    $dates->put($key, [
                        'start' => $reservation->start_date,
                        'end' => $reservation->end_date,
                    ]);
                }
            }
        }

        return $dates->map(function ($date) {
            return ['start' => $date['start'], 'end' => $date['end']];
        })->values();
    }

    public function confirmReservation($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);

        if ($reservation->status === 'pending') {
            $reservation->status = 'accepted';
            $reservation->save();


            $this->updateCarAvailabilityOnReservation($reservation->car_id, $reservation->start_date, $reservation->end_date);
        }
    }


    public function checkAndUpdateCarAvailability()
    {
        $yesterday = now()->subDay()->endOfDay();
        $carsWithEndedReservations = Reservation::where('status', 'accepted')
            ->where('end_date', '<=', $yesterday)
            ->distinct()
            ->pluck('car_id');

        foreach ($carsWithEndedReservations as $carId) {
            if ($this->isCarAvailable($carId, now(), now())) {
                Car::where('id', $carId)->update(['disponible' => 1]);
            }
        }
    }
}