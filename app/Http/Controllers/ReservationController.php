<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Reservation;
use App\Models\Car;
use Illuminate\Http\Request;

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

        $car = Car::find($validated['car_id']);
        if (!$car) {
            return back()->with('error', 'La voiture sélectionnée est invalide.');
        }

        $pricePerDayShortTerm = $car->price_per_day_short_term; // 350 DH
        $pricePerDayLongTerm = $car->price_per_day_long_term; // 300 DH

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $totalDays = $endDate->diffInDays($startDate) + 1;

        // < or = 3 DAYS
        if ($totalDays <= 3) {
            $totalCost = $totalDays * $pricePerDayShortTerm;
        } else {
            // +3 DAYS
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


    public function accept($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'accepted']);
        // Rediriger vers le dashboard avec un message de succès
        return redirect()->route('admin.dashboard')->with('success', 'Réservation acceptée.');
    }

    public function reject($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        session()->flash('success', 'Réservation supprimée avec succès.');
        return redirect()->route('dashboard');
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


}
