<?php

namespace App\Medicines\Controllers\Admin;

use Illuminate\View\View;

class ImportDataController
{
    public function create(): View
    {
        return view('admin.import-data');
    }
}
