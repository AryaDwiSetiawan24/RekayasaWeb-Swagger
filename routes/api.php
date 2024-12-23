<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

Route::apiResource('mahasiswa', MahasiswaController::class);

// Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
