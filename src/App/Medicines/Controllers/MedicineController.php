<?php

namespace App\Medicines\Controllers;

use App\Controller;
use App\Medicines\ViewModels\MedicineShowViewModel;
use Domains\Medicines\Models\Medicine;
use Illuminate\View\View;

class MedicineController extends Controller
{
    public function index(): View
    {
        return view('medicines.index');
    }

    public function show(Medicine $medicine): View
    {
        return view('medicines.show', new MedicineShowViewModel($medicine));
    }
}
