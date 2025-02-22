<?php

namespace Tests\Medicines\Integration;

use Domains\Medicines\Services\ExcelReader;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\LazyCollection;
use PHPUnit\Framework\Attributes\Test;
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

        $reader = new ExcelReader();

        $data = $reader->readFromMultipleSheets($file, [1, 2], 4);


        $this->assertInstanceOf(LazyCollection::class, $data);
        $this->assertCount(20, $data);
    }
}
