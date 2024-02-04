<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use App\Models\Car;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $cars = Car::all(); // Récupère tous les cars
    return view('app', compact('cars')); // Passe les cars à la vue
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Group all routes that require authentication
Route::middleware('auth')->group(function () {
    Route::get('/create', [CarController::class, 'create']);

    // Pas besoin de définir une route pour 'update' ici, car elle est incluse dans Route::resource
    Route::resource('cars', CarController::class);
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
Route::patch('/cars/{car}', [CarController::class, 'update'])->name('cars.update');



require __DIR__ . '/auth.php';
