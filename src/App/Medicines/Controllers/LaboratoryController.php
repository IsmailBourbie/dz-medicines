<?php

namespace App\Medicines\Controllers;

use App\Controller;
use Domains\Medicines\Models\Laboratory;
use Illuminate\View\View;

class LaboratoryController extends Controller
{

    public function __invoke(Laboratory $laboratory): View
    {
        return view('laboratories.show', compact('laboratory'));
    }
}
