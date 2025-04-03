<?php

namespace App\Medicines\Controllers\Admin;

use Domains\Medicines\Services\Contracts\ExcelFileReaderInterface;
use Domains\Medicines\Services\Contracts\FileImporterInterface;
use Domains\Medicines\Services\ImportDataService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ImportDataController
{
    public function create(): View
    {
        return view('admin.import-data');
    }

    public function store(Request $request, FileImporterInterface $importer): void
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls', 'max:10240'],
        ]);
        $file = $request->file("file");
        $importer->import($file);
    }
}
