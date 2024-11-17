<?php

use App\Medicines\Controllers\MedicineController;
use Illuminate\Support\Facades\Route;

Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');
Route::get('/medicines/{medicine}', [MedicineController::class, 'show'])->name('medicines.show');
