<?php

namespace App\Medicines\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ImportDataController
{
    public function create(): View
    {
        return view('admin.import-data');
    }

    public function store(Request $request)
    {
        // process file here
    }
}
