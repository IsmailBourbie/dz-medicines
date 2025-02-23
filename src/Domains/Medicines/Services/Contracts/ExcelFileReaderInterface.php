<?php

namespace Domains\Medicines\Services\Contracts;

use Illuminate\Support\LazyCollection;
use Spatie\SimpleExcel\SimpleExcelReader;

interface ExcelFileReaderInterface
{
    public function __construct(SimpleExcelReader $reader);

    public function read(int $sheet, $startLine = 0): LazyCollection;

    public function readFromMultipleSheets(array $sheets, $startLine = 0): LazyCollection;

}
