<?php

use App\Medicines\Controllers\LaboratoryController;
use App\Medicines\Controllers\MedicineClassController;
use App\Medicines\Controllers\MedicineController;
use Illuminate\Support\Facades\Route;

Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');
Route::get('/medicines/{medicine:slug}', [MedicineController::class, 'show'])->name('medicines.show');


Route::get('/laboratories/{laboratory}', LaboratoryController::class)->name('laboratories.show');


Route::get('/classes/{class}', MedicineClassController::class)->name('classes.show');
