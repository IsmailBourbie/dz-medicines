<?php

namespace App\Medicines\Controllers;

use App\Controller;
use Domains\Medicines\Models\Medicine;
use Illuminate\View\View;

class MedicineController extends Controller
{
    public function index(): View
    {
        return view('medicines.index', ['medicines' => Medicine::query()->paginate()]);
    }

    public function show(Medicine $medicine): View
    {
        $same_lab_medicines = $medicine->labMedicines;

        $related_medicines = $medicine->classMedicines;

        $generics = $medicine->generics;

        return view('medicines.show', compact(
            'medicine',
            'same_lab_medicines',
            'related_medicines',
            'generics',
        ));
    }
}
