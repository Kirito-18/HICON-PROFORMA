<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProformaController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [ProformaController::class, 'dashboard'])->name('dashboard');

Route::resource('proformas', ProformaController::class);

Route::get('proformas/{proforma}/pdf', [ProformaController::class, 'pdf'])
    ->name('proformas.pdf');

Route::get('proformas/{proforma}/preview', [ProformaController::class, 'preview'])
    ->name('proformas.preview');

Route::patch('proformas/{proforma}/estado', [ProformaController::class, 'cambiarEstado'])
    ->name('proformas.estado');