<?php

namespace App\Http\Controllers;

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

        Reservation::create($validated);
        session()->flash('success', 'Votre réservation a été effectuée avec succès !');
        session()->flash('reservationSuccess', true);

        return redirect()->back()->with('success', 'Votre demande de réservation a été soumise.');
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
        $reservation->update(['status' => 'rejected']);
        // Rediriger vers le dashboard avec un message de succès
        return redirect()->route('admin.dashboard')->with('success', 'Réservation rejetée.');
    }

    public function dashboard()
    {
        $reservations = Reservation::where('status', 'pending')->get(); // Récupère uniquement les réservations en attente
        // ou $reservations = Reservation::all(); pour récupérer toutes les réservations
        $reservations = Reservation::with('car')->get();
        return view('dashboard', compact('reservations'));
    }


    public function create($carId)
    {
        $car = Car::find($carId);
        if (!$car) {
            // Gérer le cas où la voiture n'existe pas
            return redirect()->route('home')->with('error', 'Voiture non trouvée.');
        }
        $model_name = $car->model_name;
        return view('reservation.create', compact('carId', 'car'));
    }


}
