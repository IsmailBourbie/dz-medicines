<?php

namespace Domains\Medicines\Services\Contracts;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\LazyCollection;
use Spatie\SimpleExcel\SimpleExcelReader;

interface ExcelFileReaderInterface
{

    public function read(SimpleExcelReader $reader, $sheet, $startLine = 0): LazyCollection;

    public function readFromMultipleSheets(UploadedFile $file, array $sheets, $startLine = 0): LazyCollection;

}
