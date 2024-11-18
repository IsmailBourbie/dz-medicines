<?php

namespace App\Medicines\Controllers;

use App\Http\Controllers\Controller;
use Domains\Medicines\Models\Medicine;
use Illuminate\View\View;

class MedicineController extends Controller
{
    public function index(): View
    {
        return view('medicines.index');
    }

    public function show(string $slug): View
    {
        $medicine = Medicine::query()->whereSlug($slug)->get()->first();
        
        return view('medicines.show', compact('medicine'));
    }
}
