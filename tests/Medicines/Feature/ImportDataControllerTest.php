<?php

namespace Tests\Medicines\Feature;

use Domains\Medicines\Services\ImportDataService;
use Illuminate\Http\UploadedFile;
use Mockery\MockInterface;
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

        $this->mock('overload:'.ImportDataService::class, function (MockInterface $mock) {
            $mock->shouldReceive('importAllData')->once()->andReturnNull();
        });


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
}
