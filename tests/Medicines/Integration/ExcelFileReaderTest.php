<?php

namespace Tests\Medicines\Integration;

use Domains\Medicines\Services\Contracts\FileReaderInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\LazyCollection;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ExcelFileReaderTest extends TestCase
{

    protected UploadedFile $file;

    protected function setUp(): void
    {
        parent::setUp();

        $filePath = base_path('tests\Fixtures\medicines.xlsx');
        $this->file = new UploadedFile(
            $filePath,
            'medicines.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );
    }

    #[Test]
    public function it_read_a_file(): void
    {
        $reader = $this->app->make(FileReaderInterface::class);

        $data = $reader->read($this->file);

        $this->assertInstanceOf(LazyCollection::class, $data);
        $this->assertCount(20, $data);
    }

}
