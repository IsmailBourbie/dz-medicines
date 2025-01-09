<?php

namespace App\Medicines\Controllers;

use App\Controller;
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
        $medicine->loadMissing(['code', 'class', 'laboratory']);
        $generics = $medicine->code->medicines()->filterOutMedicine($medicine->id)->get();
        $classMedicines = $medicine->class->medicines()->filterOutMedicine($medicine->id)->get();
        $labMedicines = $medicine->laboratory->medicines()->filterOutMedicine($medicine->id)->get();

        return view('medicines.show', compact(
            'medicine',
            'generics',
            'classMedicines',
            'labMedicines'
        ));
    }
}
