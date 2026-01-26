
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JugadoraController;

Route::prefix('jugadores')->name('api.jugadoras.')->group(function () {
    Route::get('/', [JugadoraController::class, 'index'])->name('index');      // /api/jugadores
    Route::get('/{id}', [JugadoraController::class, 'show'])->name('show');    // /api/jugadores/1
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



