<?php

namespace Domains\Medicines\Services;

use Domains\Medicines\Services\Contracts\ExcelFileReaderInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\LazyCollection;
use Spatie\SimpleExcel\SimpleExcelReader;

class ExcelReader implements ExcelFileReaderInterface
{

    public function read(SimpleExcelReader $reader, $sheet, $startLine = 0): LazyCollection
    {
        return new LazyCollection();
    }

    public function readFromMultipleSheets(UploadedFile $file, array $sheets, $startLine = 0): LazyCollection
    {
        $simpleReader = SimpleExcelReader::create($file);

        return LazyCollection::make($sheets)
            ->map(function ($sheet) use ($startLine, $simpleReader) {
                return LazyCollection::make(function () use ($sheet, $simpleReader, $startLine) {
                    yield from $simpleReader->fromSheet($sheet)
                        ->trimHeaderRow()
                        ->headerOnRow($startLine)
                        ->getRows()
                        ->filter(fn($row) => trim($row['CODE']) !== '');
                });
            })->collapse();
    }
}
