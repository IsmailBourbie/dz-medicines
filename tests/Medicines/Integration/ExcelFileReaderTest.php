<?php

namespace Tests\Medicines\Integration;

use Domains\Medicines\Services\Contracts\FileReaderInterface;
use Illuminate\Support\LazyCollection;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ExcelFileReaderTest extends TestCase
{

    protected string $filepath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->filepath = base_path('tests\Fixtures\medicines.xlsx');
    }

    #[Test]
    public function it_read_a_file(): void
    {
        $this->withoutExceptionHandling();
        $reader = $this->app->make(FileReaderInterface::class);
        
        $data = $reader->read($this->filepath);

        $this->assertInstanceOf(LazyCollection::class, $data);
        $this->assertCount(20, $data);
    }

}
