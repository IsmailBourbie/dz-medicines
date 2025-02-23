<?php

namespace Tests\Medicines\Integration;

use Domains\Medicines\Services\ExcelReader;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\LazyCollection;
use PHPUnit\Framework\Attributes\Test;
use Spatie\SimpleExcel\SimpleExcelReader;
use Tests\TestCase;

class ExcelReaderTest extends TestCase
{
    #[Test]
    public function it_read_from_multiple_sheets(): void
    {
        $filePath = base_path('tests\Fixtures\medicines.xlsx');
        $file = new UploadedFile(
            $filePath,
            'medicines.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );

        $simpleExcelReader = SimpleExcelReader::create($file);

        $reader = $this->app->make(ExcelReader::class, ['reader' => $simpleExcelReader]);


        $data = $reader->readFromMultipleSheets([1, 2], 4);


        $this->assertInstanceOf(LazyCollection::class, $data);
        $this->assertCount(20, $data);
    }
}
