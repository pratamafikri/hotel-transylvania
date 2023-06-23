<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/room', [RoomController::class,'index'])->name('room');
Route::get('/room/create', [RoomController::class, 'create'])->name('room.create');
Route::post('/room/store', [RoomController::class, 'store'])->name('room.store');
Route::get('/room/{id}/edit', [RoomController::class, 'edit'])->name('room.edit');
Route::post('/room/{id}/update', [RoomController::class, 'update'])->name('room.update');
Route::get('/room/{id}/delete', [RoomController::class, 'destroy'])->name('room.destroy');

Route::get('/room/checkin', [RoomController::class,'checkin'])->name('room.checkin');
Route::post('/room/{id}/update_checkin', [RoomController::class, 'update_checkin'])->name('room.update_checkin');

// Route::get('/room/findCodeReservation', [RoomController::class,'findCodeReservation'])->name('room.findCodeReservation');

Route::get('/book', [BookingController::class, 'index'])->name('book.index');
Route::get('/book/search', [BookingController::class, 'getAvailableRoom'])->name('book.search');
Route::post('/book/create', [BookingController::class, 'create'])->name('book.create');
Route::get('/book/invoice/{id}', [BookingController::class, 'printInvoice'])->name('book.invoice');

Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.submit');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
