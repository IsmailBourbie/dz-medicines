<?php

namespace Tests\Medicines\Feature;

use Domains\Medicines\Services\Contracts\ExcelFileReaderInterface;
use Domains\Medicines\Services\ImportDataService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\LazyCollection;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ImportDataControllerTest extends TestCase
{

    #[Test]
    public function it_render_import_page(): void
    {
        $this->get(route('admin.import-data.create'))
            ->assertSuccessful()
            ->assertViewIs('admin.import-data');
    }

    #[Test]
    public function it_import_data_and_save_it_to_database(): void
    {

        $this->instance(
            ImportDataService::class,
            $this->mock(ImportDataService::class, function (MockInterface $mock) {
                $mock->shouldReceive('importAllData')
                    ->withArgs(function ($collection) {
                        return $collection instanceof LazyCollection;
                    })
                    ->once()
                    ->andReturnNull();
            })
        );

        $this->instance(
            ExcelFileReaderInterface::class,
            $this->mock(ExcelFileReaderInterface::class, function (MockInterface $mock) {
                $mock->shouldReceive('readFromMultipleSheets')
                    ->withArgs(function ($file, $sheets, $startLine) {
                        return $file instanceof UploadedFile && count($sheets) === 2 && $startLine === 4;
                    })
                    ->once()
                    ->andReturnUsing(function () {
                        new LazyCollection();
                    });
            })
        );

        $filePath = base_path('tests\Fixtures\medicines.xlsx');
        $file = new UploadedFile(
            $filePath,
            'medicines.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );

        $this->post(route('admin.import-data.store'), [
            'file' => $file,
        ])
            ->assertSuccessful();
    }

    #[Test]
    #[DataProvider('validationDataProvider')]
    public function it_required_validated_file($inputName, $inputValue): void
    {
        $spy = $this->spy(ImportDataService::class);
        $this->instance(ImportDataService::class, $spy);

        $this->post(route('admin.import-data.store'), [$inputName => $inputValue])
            ->assertSessionHasErrors($inputName);

        $spy->shouldNotHaveReceived('importAllData');
    }

    public static function validationDataProvider(): array
    {
        return [
            'the file is required' => ['file', null],
            'the file must be file type' => ['file', 'filename'],
            'the file must be excel file' => ['file', UploadedFile::fake()->create('medicines.pdf')],
            'the file must be less than 10Mb' => ['file', UploadedFile::fake()->create('medicines.xlsx', 10241)],
        ];
    }
}
