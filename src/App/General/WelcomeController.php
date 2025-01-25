<?php

namespace App\General;

use Domains\Medicines\Models\MedicineClass;
use Illuminate\View\View;

class WelcomeController
{
    public function __invoke(): View
    {
        $medicineClasses = MedicineClass::query()->inRandomOrder()->limit(12)->get();

        return view('welcome', compact('medicineClasses'));

    }
}
