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

    protected SimpleExcelReader $simpleExcelReader;

    protected function setUp(): void
    {
        parent::setUp();

        $filePath = base_path('tests\Fixtures\medicines.xlsx');
        $file = new UploadedFile(
            $filePath,
            'medicines.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );
        $this->simpleExcelReader = SimpleExcelReader::create($file);
    }

    #[Test]
    public function it_read_from_sheet(): void
    {
        $reader = $this->app->make(ExcelReader::class, ['reader' => $this->simpleExcelReader]);

        $data = $reader->read(1, 4);

        $this->assertInstanceOf(LazyCollection::class, $data);
        $this->assertCount(10, $data);
    }

    #[Test]
    public function it_read_from_multiple_sheets(): void
    {
        $reader = $this->app->make(ExcelReader::class, ['reader' => $this->simpleExcelReader]);
        
        $data = $reader->readFromMultipleSheets([1, 2], 4);

        $this->assertInstanceOf(LazyCollection::class, $data);
        $this->assertCount(20, $data);
    }
}
