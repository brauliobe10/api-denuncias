<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DenunciaController;

Route::prefix('denuncias')->group(function () {
    Route::post('/', [DenunciaController::class, 'store']);
    Route::get('/', [DenunciaController::class, 'index']);
    Route::get('/{id}', [DenunciaController::class, 'show'])->where('id', '[0-9]+');
    Route::get('/ciudadano/{dni}', [DenunciaController::class, 'getByCiudadano']);
    Route::put('/{id}', [DenunciaController::class, 'atender'])->where('id', '[0-9]+');
});