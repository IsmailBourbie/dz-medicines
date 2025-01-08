<?php

namespace App\Medicines\Controllers;

use App\Controller;
use Domains\Medicines\Models\MedicineClass;
use Illuminate\View\View;

class MedicineClassController extends Controller
{

    public function __invoke(MedicineClass $class): View
    {
        return view('classes.show', compact('class'));
    }
}
