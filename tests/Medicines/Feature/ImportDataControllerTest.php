<?php

namespace Tests\Medicines\Feature;

use Domains\Medicines\Models\Code;
use Domains\Medicines\Models\Laboratory;
use Domains\Medicines\Models\Medicine;
use Illuminate\Http\UploadedFile;
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
        $filePath = base_path('tests\Fixtures\medicines.xlsx');
        $file = new UploadedFile(
            $filePath,
            'medicines.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true);

        $response = $this->post(route('admin.import-data.store'), [
            'file' => $file,
        ]);

        $response->assertSuccessful();
        $this->assertDatabaseCount(Medicine::class, 10);
        $this->assertDatabaseCount(Code::class, 8);
        $this->assertDatabaseCount(Laboratory::class, 18);
    }
}
