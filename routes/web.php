<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard (público)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

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



/*
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Ruta per canviar idioma (i18n) 👈 AFEGEIX AIXÒ
Route::get('/locale/{locale}', function (string $locale) {
    $available = ['ca', 'es', 'en'];

    if (!in_array($locale, $available, true)) {
        $locale = config('app.fallback_locale', 'en');
    }

    Session::put('locale', $locale);

    return redirect()->back();
})->name('setLocale');

// ✅ Públicos: SOLO index (para evitar conflicto con /create)
Route::resource('equips', EquipController::class)->only(['index']);
Route::resource('estadis', EstadiController::class)->only(['index']);
Route::resource('jugadores', JugadoraController::class)->only(['index']);
Route::resource('partits', PartitController::class)->only(['index']);


// 🔒 Protegidos: crear/editar/borrar (y store/update/destroy)
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('equips', EquipController::class)->except(['index', 'show']);
    Route::resource('estadis', EstadiController::class)->except(['index', 'show']);
    Route::resource('jugadores', JugadoraController::class)->except(['index', 'show']);
    Route::resource('partits', PartitController::class)->except(['index', 'show']);
});

// ✅ Públicos: show AL FINAL (así /create no lo captura {id})
Route::resource('equips', EquipController::class)->only(['show']);
Route::resource('estadis', EstadiController::class)->only(['show']);
Route::resource('jugadores', JugadoraController::class)->only(['show']);
Route::resource('partits', PartitController::class)->only(['show']);


require __DIR__ . '/auth.php';
*/