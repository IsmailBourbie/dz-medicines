<?php

namespace Tests\Medicines\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicinesControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_render_index_page(): void
    {
        $response = $this->get(route('medicines.index'));

        $response->assertStatus(200);
    }
}
