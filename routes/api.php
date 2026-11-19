<?php

use App\Http\Controllers\Api\StrutturaController;
use App\Http\Controllers\Api\PrenotazioneController;

Route::get('/struttura', [StrutturaController::class, 'mostra']);
Route::post('/prenotazioni/preventivo', [PrenotazioneController::class, 'preventivo']);
Route::post('/prenotazioni', [PrenotazioneController::class, 'crea']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/prenotazioni', [PrenotazioneController::class, 'elenco']);
    Route::patch('/admin/prenotazioni/{prenotazione}/stato', [PrenotazioneController::class, 'aggiornaStato']);
});