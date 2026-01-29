
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JugadoraController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EquipController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Exemple: protegim els endpoints d'escriptura
    Route::apiResource('jugadores', JugadoraController::class)
        ->parameters(['jugadores' => 'jugadora'])
        ->except(['index', 'show']);
});

// Endpoints públics (lectura)
Route::apiResource('jugadores', JugadoraController::class)
    ->parameters(['jugadores' => 'jugadora'])
    ->only(['index', 'show']);

Route::prefix('equips')->name('api.equips.')->group(function () {
    Route::apiResource('/', EquipController::class)
        ->parameters(['' => 'equip']);
});

Route::prefix('jugadores')->name('api.jugadoras.')->group(function () {
    Route::get('/', [JugadoraController::class, 'index'])->name('index');
    Route::get('/{id}', [JugadoraController::class, 'show'])->name('show');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
