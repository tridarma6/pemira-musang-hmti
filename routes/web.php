<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KandidatController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [KandidatController::class, 'index'])->name('kandidat.index');

Route::get('/result', function () {
    return view('result');
});
Route::get('/result', [KandidatController::class, 'hasil'])->name('kandidat.hasil');
Route::post('/kandidat/{id}/tambah-suara', [KandidatController::class, 'tambahSuara'])->name('kandidat.tambah-suara');
Route::post('/kandidat/{id}/kurang-suara', [KandidatController::class, 'kurangSuara'])->name('kandidat.kurang-suara');
