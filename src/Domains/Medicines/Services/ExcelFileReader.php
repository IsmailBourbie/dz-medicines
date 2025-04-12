<?php

namespace Domains\Medicines\Services;

use Illuminate\Support\LazyCollection;
use Spatie\SimpleExcel\SimpleExcelReader;

class ExcelFileReader implements Contracts\FileReaderInterface
{
    public function read(string $filepath): LazyCollection
    {
        $reader = SimpleExcelReader::create($filepath);

        return LazyCollection::make(config('MedicinesImport.sheets'))
            ->flatMap(function ($sheet) use ($reader) {
                return $reader->fromSheet($sheet)
                    ->headerOnRow(config('MedicinesImport.start_line'))
                    ->getRows()
                    ->filter(fn($row) => trim($row['CODE']) !== '');
            });
    }
}
