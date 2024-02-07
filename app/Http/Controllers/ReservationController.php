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
            return back()->with('success', "Votre réservation a été effectuée avec succès ! Le coût total est de $totalCost €.");
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
        $reservation->status = 'accepted';
        $reservation->save();

        // Générer le PDF
        $pdf = PDF::loadView('emails.reservation_pdf', ['reservation' => $reservation]);

        // L'email du destinataire est directement un champ de la réservation
        $to_email = $reservation->email; // Utilisez directement l'email de la réservation

        $data = [
            'reservation' => $reservation // Passer l'objet reservation complet
        ];

        Mail::send('emails.reservation.confirmation', $data, function ($message) use ($pdf, $reservation) {
            $message->to($reservation->email)
                ->subject('Confirmation de Réservation')
                ->attachData($pdf->output(), "confirmation_reservation.pdf");
        });
        return redirect()->route('dashboard')->with('success', 'La réservation a été acceptée avec succès et l\'email a été envoyé.');

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

        // Supprimer la réservation
        $reservation->delete();

        // Rediriger vers le dashboard (ou une autre page de votre choix) avec un message de succès
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
        return view('reservation.create', compact('carId', 'car'));
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $email = $reservation->email; // Assurez-vous que l'email est disponible dans votre modèle de réservation
        $firstName = $reservation->first_name; // Pour personnaliser l'email d'annulation

        // Envoyer l'email d'annulation ici
        Mail::send('emails.reservation_canceled', ['firstName' => $firstName, 'reservation' => $reservation], function ($message) use ($email) {
            $message->to($email)->subject('Annulation de votre réservation');
        });


        // Supprimer la réservation
        $reservation->delete();

        return back()->with('success', 'La réservation a été annulée avec succès.');
    }

}
