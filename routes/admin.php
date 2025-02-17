<?php

use App\Medicines\Controllers\Admin\ImportDataController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/import-data', [ImportDataController::class, 'create'])->name('import-data.create');
    Route::post('/import-data', [ImportDataController::class, 'store'])->name('import-data.store');
});
