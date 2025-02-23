<?php

namespace Domains\Medicines\Services;

use Domains\Medicines\Services\Contracts\ExcelFileReaderInterface;
use Illuminate\Support\LazyCollection;
use Spatie\SimpleExcel\SimpleExcelReader;

final readonly class ExcelReader implements ExcelFileReaderInterface
{

    public function __construct(private SimpleExcelReader $reader)
    {
    }

    public function read(int $sheet, $startLine = 0): LazyCollection
    {
        return LazyCollection::make(function () use ($sheet, $startLine) {
            yield from $this->reader->fromSheet($sheet)
                ->trimHeaderRow()
                ->headerOnRow($startLine)
                ->getRows()
                ->filter(fn($row) => trim($row['CODE']) !== '');
        });
    }

    public function readFromMultipleSheets(array $sheets, $startLine = 0): LazyCollection
    {
        return LazyCollection::make($sheets)
            ->map(function ($sheet) use ($startLine) {
                return $this->read($sheet, $startLine);
            })->collapse();
    }
}
