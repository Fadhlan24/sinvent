<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
 
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/kategori', \App\Http\Controllers\KategoriController::class);
    Route::resource('/barang', \App\Http\Controllers\BarangController::class);
    Route::resource('/barangmasuk', \App\Http\Controllers\BarangMasukController::class);
    Route::resource('/barangkeluar', \App\Http\Controllers\BarangKeluarController::class);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});