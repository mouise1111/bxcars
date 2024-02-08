<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        $totalCars = Car::count();
        return view('app', compact('cars', 'totalCars'));
    }


    public function create()
    {
        $cars = Car::all();
        return view('cars.create', compact('cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'model_name' => 'required|string|max:255',
            'price_per_day_short_term' => 'required|numeric',
            'price_per_day_long_term' => 'required|numeric',
            'price_caution' => 'required|numeric',
            'total_km' => 'required|integer',
            'transmission' => 'required|string',
            'seats' => 'required|integer',
            'fuel_type' => 'required|string',
            'photo' => 'nullable|image|max:1999',
            'disponible' => 'boolean',
        ]);

        $path = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/cars');
        }

        $car = new Car;
        $car->model_name = $request->model_name;
        $car->price_per_day_short_term = $request->price_per_day_short_term;
        $car->price_per_day_long_term = $request->price_per_day_long_term;
        $car->price_caution = $request->price_caution;
        $car->total_km = $request->total_km;
        $car->transmission = $request->transmission;
        $car->seats = $request->seats;
        $car->fuel_type = $request->fuel_type;
        $car->photo = $path;
        $car->disponible = $request->input('disponible', false);
        $car->save();

        return redirect()->route('cars.index')->with('success', 'Le véhicule a bien été ajouté.');
    }


    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validatedData = $request->validate([
            'model_name' => 'required|string|max:255',
            'price_per_day_short_term' => 'required|numeric',
            'price_per_day_long_term' => 'required|numeric',
            'price_caution' => 'required|numeric',
            'total_km' => 'required|numeric',
            'transmission' => 'required|string',
            'seats' => 'required|integer',
            'fuel_type' => 'required|string',
            'photo' => 'sometimes|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'disponible' => 'required|boolean',
        ]);

        if ($request->hasFile('photo')) {
            Log::info('Fichier photo reçu', ['file_exists' => $request->file('photo')->isValid(), 'file_name' => $request->file('photo')->getClientOriginalName()]);
        }

        if ($request->hasFile('photo')) {
            $oldPhotoPath = str_replace(asset('storage'), 'public', parse_url($car->photo, PHP_URL_PATH));
            if (Storage::exists($oldPhotoPath)) {
                Storage::delete($oldPhotoPath);
            }

            $path = $request->file('photo')->store('public/cars');
            $url = Storage::url($path);
            $car->photo = $url;

            $car->save();
        }

        $car->update($validatedData);
        return redirect()->route('cars.index')->with('success', 'Véhicule mis à jour avec succès.');


    }


    public function destroy(Car $car)
    {
        if ($car->photo) {
            Storage::delete($car->photo);
        }

        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Car deleted successfully');
    }
    public function toggleAvailability(Car $car)
    {
        $car->disponible = !$car->disponible;
        $car->save();

        return back()->with('success', 'La disponibilité du véhicule a été mise à jour.');
    }

}
