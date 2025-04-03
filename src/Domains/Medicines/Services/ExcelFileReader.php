<?php

namespace Domains\Medicines\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\LazyCollection;
use Spatie\SimpleExcel\SimpleExcelReader;

class ExcelFileReader implements Contracts\FileReaderInterface
{
    private const SHEETS = [1, 2];
    private const START_LINE = 4;

    public function read(UploadedFile $file): LazyCollection
    {
        $reader = SimpleExcelReader::create($file);

        return LazyCollection::make(self::SHEETS)
            ->flatMap(function ($sheet) use ($reader) {
                return $reader->fromSheet($sheet)
                    ->headerOnRow(self::START_LINE)
                    ->getRows()
                    ->filter(fn($row) => trim($row['CODE']) !== '');
            });
    }
}
