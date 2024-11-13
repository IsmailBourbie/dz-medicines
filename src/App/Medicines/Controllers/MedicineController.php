<?php

namespace App\Medicines\Controllers;

use App\Http\Controllers\Controller;
use Domains\Medicines\Models\Medicine;
use Illuminate\View\View;

class MedicineController extends Controller
{
    public function index(): View
    {
        return view('medicines.index', ['medicines' => Medicine::query()->with('dci')->get()]);
    }
}
