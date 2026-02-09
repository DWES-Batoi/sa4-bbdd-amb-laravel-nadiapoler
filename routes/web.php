<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard (público)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

Route::middleware(['auth', 'not.convidat'])->group(function () {
    Route::resource('equips', EquipController::class)->except(['index', 'show']);
    Route::resource('jugadores', JugadoraController::class)->except(['index', 'show']);
    // ...altres recursos d’escriptura
});

// 🌍 Cambio de idioma
Route::get('/locale/{locale}', function (string $locale) {
    $available = ['ca', 'es', 'en'];

    if (!in_array($locale, $available, true)) {
        $locale = config('app.fallback_locale', 'en');
    }

    Session::put('locale', $locale);

    return redirect(url()->previous() ?? url('/'))
        ->withCookie(cookie('locale', $locale, 60 * 24 * 30));
})->name('setLocale');



// 📌 TODAS LAS RUTAS PÚBLICAS (sin login)
Route::resource('equips', EquipController::class);
Route::resource('estadis', EstadiController::class);
Route::resource('jugadores', JugadoraController::class)
    ->parameters(['jugadores' => 'jugadora']);
Route::resource('partits', PartitController::class);

// Breeze (no afecta)
require __DIR__ . '/auth.php';
