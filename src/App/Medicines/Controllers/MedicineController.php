<?php

namespace App\Medicines\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Tests\Medicines\Models\Medicine;

class MedicineController extends Controller
{
    public function index(): View
    {
        return view('medicines.index', ['medicines' => Medicine::all()]);
    }
}
