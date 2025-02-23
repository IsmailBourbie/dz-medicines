<?php

namespace App\Medicines\Controllers\Admin;

use Domains\Medicines\Services\Contracts\ExcelFileReaderInterface;
use Domains\Medicines\Services\ImportDataService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportDataController
{
    public function create(): View
    {
        return view('admin.import-data');
    }

    public function store(Request $request, ImportDataService $importService): void
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls', 'max:10240'],
        ]);

        $simpleReader = resolve(SimpleExcelReader::class, ['path' => $request->file('file')]);

        $reader = resolve(ExcelFileReaderInterface::class, ['reader' => $simpleReader]);

        $data = $reader->readFromMultipleSheets([1, 2], 4);

        $importService->importAllData($data);

    }
}
