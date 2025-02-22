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

    public function store(Request $request, ExcelFileReaderInterface $reader, ImportDataService $importService): void
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls', 'max:10240'],
        ]);


//        $reader->readFromMultipleSheet($file, [1, 2], 4);

        $reader->readFromMultipleSheets($request->file('file'), [1, 2], 4);


        $readerSheetOne = SimpleExcelReader::create($request->file('file'))
            ->fromSheet(1)
            ->trimHeaderRow()
            ->headerOnRow(4)->getRows();

        $readerSheetTwo = SimpleExcelReader::create($request->file('file'))
            ->fromSheet(2)
            ->trimHeaderRow()
            ->headerOnRow(4)->getRows();


        $importService->importAllData($readerSheetOne->merge($readerSheetTwo));

    }
}
