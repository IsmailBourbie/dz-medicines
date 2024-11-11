<?php

namespace Tests\Medicines\Controllers;

use Database\Factories\MedicineFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicinesControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_render_index_page_successfully(): void
    {
        $response = $this->get(route('medicines.index'));

        $response->assertStatus(200);
        $response->assertViewIs('medicines.index');
    }

    #[Test]
    public function it_show_all_existed_medicines_names(): void
    {
        $this->withoutExceptionHandling();
        $medicines = MedicineFactory::new()->count(5)->create();
        $response = $this->get(route('medicines.index'));

        $response->assertSee($medicines->pluck('name')->toArray());
    }
}
