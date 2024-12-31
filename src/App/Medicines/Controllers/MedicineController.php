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
        $same_lab_medicines = $medicine->laboratory->medicines()
            ->where('id', '!=', $medicine->id)
            ->get();

        $related_medicines = $medicine->classRelatedMedicines();

        $generics = $medicine->generics();

        return view('medicines.show', compact(
            'medicine',
            'same_lab_medicines',
            'related_medicines',
            'generics',
        ));
    }
}
