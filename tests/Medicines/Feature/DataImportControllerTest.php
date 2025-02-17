<?php

namespace Tests\Medicines\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DataImportControllerTest extends TestCase
{
    #[Test]
    public function it_render_import_page(): void
    {
        $this->get(route('admin.import-data.create'))
            ->assertSuccessful()
            ->assertViewIs('admin.import-data');
    }
}
