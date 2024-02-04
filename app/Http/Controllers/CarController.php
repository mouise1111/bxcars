<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return view('app', compact('cars'));
    }

    public function create()
    {
        $cars = Car::all();
        return view('cars.create', compact('cars'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données reçues
        $request->validate([
            'model_name' => 'required|string|max:255',
            'price_per_day' => 'required|numeric',
            'price_caution' => 'required|numeric',
            'total_km' => 'required|integer',
            'transmission' => 'required|string',
            'seats' => 'required|integer',
            'fuel_type' => 'required|string',
            'photo' => 'nullable|image|max:1999',
            'disponible' => 'boolean',
        ]);

        // Traitement de l'upload de la photo si une photo est envoyée
        $path = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/cars');
            // Pour stocker le chemin dans la base de données, vous pourriez vouloir enregistrer seulement le nom du fichier,
            // ou ajuster le chemin selon votre structure de stockage.
        }

        // Création de l'instance Car et sauvegarde avec les données validées
        $car = new Car;
        $car->model_name = $request->model_name;
        $car->price_per_day = $request->price_per_day;
        $car->price_caution = $request->price_caution;
        $car->total_km = $request->total_km;
        $car->transmission = $request->transmission;
        $car->seats = $request->seats;
        $car->fuel_type = $request->fuel_type;
        $car->photo = $path;
        $car->disponible = $request->input('disponible', false);
        $car->save();

        // Redirection ou réponse après la création
        return redirect()->route('cars.index')->with('success', 'Car added successfully.');
    }

    /**
     * Display the specified resource.
     */
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
            'price_per_day' => 'required|numeric',
            'price_caution' => 'required|numeric',
            'total_km' => 'required|numeric',
            'transmission' => 'required|string',
            'seats' => 'required|integer',
            'fuel_type' => 'required|string',
            'photo' => 'sometimes|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'disponible' => 'required|boolean',
        ]);

        if ($request->hasFile('photo')) {
            // Log pour vérifier que le fichier est reçu
            Log::info('Fichier photo reçu', ['file_exists' => $request->file('photo')->isValid(), 'file_name' => $request->file('photo')->getClientOriginalName()]);

            // Le reste de votre logique pour gérer le fichier...
        }

        if ($request->hasFile('photo')) {
            // Suppression de l'ancienne photo si elle existe
            $oldPhotoPath = str_replace(asset('storage'), 'public', parse_url($car->photo, PHP_URL_PATH));
            if (Storage::exists($oldPhotoPath)) {
                Storage::delete($oldPhotoPath);
            }

            // Téléchargement de la nouvelle photo et mise à jour de l'attribut 'photo'
            $path = $request->file('photo')->store('public/cars');
            $url = Storage::url($path);
            $car->photo = $url;

            $car->save(); // N'oubliez pas de sauvegarder les changements
        }

        // Mise à jour des autres attributs du véhicule
        $car->update($validatedData);
        return redirect()->route('cars.index')->with('success', 'Véhicule mis à jour avec succès.');


    }


    public function destroy(Car $car)
    {
        // Assurez-vous d'avoir la logique pour supprimer l'image associée si nécessaire
        if ($car->photo) {
            Storage::delete($car->photo);
        }

        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Car deleted successfully');
    }
}
