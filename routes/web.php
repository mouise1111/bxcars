<?php
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomepageParagraphController;
use Illuminate\Support\Facades\Route;
use App\Models\Car;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
Route::get('/register', function () {
    return redirect('/');
});

Route::get('/', function () {
    $cars = Car::all();
    $totalCars = Car::count();
    return view('app', compact('cars', 'totalCars'));
})->name('home');

Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('/about', function () {
    return view('about');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::redirect('/reservation', '/dashboard');

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
Route::post('/send-promotion-email', [ReservationController::class, 'sendPromotionEmail'])->name('send.promotion.email');

Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

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

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');

Route::get('/services', [ServicesController::class, 'index'])->name('services.index');

Route::get('/admin/paragraph/edit', [HomepageParagraphController::class, 'edit']);
Route::post('/admin/paragraph/update', [HomepageParagraphController::class, 'update']);
