<?php
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MembreController;
use Illuminate\Support\Facades\Route;
use App\Models\Car;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $cars = Car::all();
    $totalCars = Car::count();
    return view('app', compact('cars', 'totalCars'));
})->name('home');

Route::get('/about', function () {
    return view('about');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/create', [CarController::class, 'create']);
    Route::resource('cars', CarController::class);
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
Route::patch('/cars/{car}', [CarController::class, 'update'])->name('cars.update');


Route::get('/reservation/{car}', [ReservationController::class, 'create'])->name('reservation.create');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::patch('/reservations/{id}/accept', [ReservationController::class, 'accept'])->name('admin.reservations.accept');
Route::post('/reservations/{id}/reject', [ReservationController::class, 'reject'])->name('reservations.reject');

Route::get('/dashboard', [ReservationController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/reservation/{car}', [ReservationController::class, 'create'])->name('reservation.create');
Route::patch('/admin/cars/{car}/toggle_availability', [CarController::class, 'toggleAvailability'])->name('admin.cars.toggle_availability');

Route::get('/about', [MembreController::class, 'about'])->name('about');
Route::get('/membres/create', [MembreController::class, 'create'])->name('membres.create');
Route::post('/membres', [MembreController::class, 'store'])->name('membres.store');
Route::get('/membres', [MembreController::class, 'index'])->name('membres.index');


Route::put('/membres/{membre}', [MembreController::class, 'update'])->name('membres.update');
Route::get('/membres/{membre}/edit', [MembreController::class, 'edit'])->name('membres.edit');
Route::delete('/membres/{membre}', [MembreController::class, 'destroy'])->name('membres.destroy');

Route::post('/maintenance/activate', [MaintenanceController::class, 'activateMaintenance'])->name('maintenance.activate');
Route::post('/maintenance/deactivate', [MaintenanceController::class, 'deactivateMaintenance'])->name('maintenance.deactivate');
Route::get('/maintenance-control', function () {
    return view('OnOffMaintenance');
})->middleware('auth');


require __DIR__ . '/auth.php';
