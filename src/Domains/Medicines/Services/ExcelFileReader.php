<?php

namespace Domains\Medicines\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\LazyCollection;
use Spatie\SimpleExcel\SimpleExcelReader;

class ExcelFileReader implements Contracts\FileReaderInterface
{
    public function read(UploadedFile $file): LazyCollection
    {
        $reader = SimpleExcelReader::create($file);

        return LazyCollection::make(config('MedicinesImport.sheets'))
            ->flatMap(function ($sheet) use ($reader) {
                return $reader->fromSheet($sheet)
                    ->headerOnRow(config('MedicinesImport.start_line'))
                    ->getRows()
                    ->filter(fn($row) => trim($row['CODE']) !== '');
            });
    }
}
