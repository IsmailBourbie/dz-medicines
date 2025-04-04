<?php

namespace Tests\Medicines\Feature;

use Domains\Medicines\Services\Contracts\FileImporterInterface;
use Illuminate\Http\UploadedFile;
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
        $this->withoutExceptionHandling();
        $file = UploadedFile::fake()->create('medicines.xlsx');

        $this->instance(
            FileImporterInterface::class,
            $this->mock(FileImporterInterface::class, function (MockInterface $mock) {
                $mock->shouldReceive('import')
                    ->withArgs(function ($file) {
                        return $file instanceof UploadedFile;
                    })
                    ->once();
            })
        );

        $this->post(route('admin.import-data.store'), ['file' => $file])
            ->assertSuccessful();
    }

    #[
        Test]
    #[DataProvider('validationDataProvider')]
    public function it_required_validated_file($inputName, $inputValue): void
    {
        $spy = $this->spy(FileImporterInterface::class);
        $this->instance(FileImporterInterface::class, $spy);

        $this->post(route('admin.import-data.store'), [$inputName => $inputValue])
            ->assertSessionHasErrors($inputName);

        $spy->shouldNotHaveReceived('import');
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
