<?php

namespace App\Medicines\Controllers\Admin;

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

    public function store(Request $request): void
    {

        $reader = SimpleExcelReader::create($request->file('file'))
            ->fromSheet(2)
            ->trimHeaderRow()
            ->headerOnRow(4);

        dd($reader->getRows()->all());

        $importService = new ImportDataService($reader->getRows());
//        function (array $row) {
//                // create laboratory with slug
//                // retrieve speciality from code
//                // create the Code
//                // create Medicine
//                dump($row["LABORATOIRES DETENTEUR DE LA DECISION D'ENREGISTREMENT"]);
//            }

        dd('end');

    }
}
