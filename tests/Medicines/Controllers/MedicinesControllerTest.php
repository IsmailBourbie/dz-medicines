<?php

namespace Tests\Medicines\Controllers;

use Database\Factories\DciFactory;
use Database\Factories\MedicineFactory;
use Domains\Medicines\Models\Medicine;
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
        $medicines = MedicineFactory::new()->count(5)->create()->each(function (Medicine $medicine) {
            $medicine->dci()->attach(
                DciFactory::new()->createOne(),
                [
                    'form' => 'COMP',
                    'dosage' => '1000mg',
                    'packaging' => 'bte 8',
                ]
            );
        });
        $response = $this->get(route('medicines.index'));

        $response->assertSee(
            $medicines->pluck('name')
                ->map(fn($str) => strtoupper($str))
                ->toArray()
        );
    }

    #[Test]
    public function it_show_medicine_on_with_full_details(): void
    {
        $amlodipine = DciFactory::new()->createOne(['name' => 'amlodipine']);
        $valsartan = DciFactory::new()->createOne(['name' => 'valsartan']);

        $exval = MedicineFactory::new()->createOne(['name' => 'exval']);
        $amlor = MedicineFactory::new()->createOne(['name' => 'amlor']);

        // With Combined DCI
        $exval->dci()->attach($amlodipine, [
            'form' => 'COMP',
            'dosage' => '5mg',
            'packaging' => 'Bte 30',
        ]);
        $exval->dci()->attach($valsartan, [
            'form' => 'COMP',
            'dosage' => '80mg',
            'packaging' => 'Bte 30',
        ]);
        // With Single Dci
        $amlor->dci()->attach($amlodipine, [
            'form' => 'COMP',
            'dosage' => '5mg',
            'packaging' => 'Bte 30',
        ]);

        $response = $this->get(route('medicines.index'));

        $response->assertSeeTextInOrder([
            'EXVAL', 'Amlodipine/Valsartan', '5mg/80mg', 'COMP', 'BTE 30',
        ]);
        $response->assertSeeTextInOrder([
            'AMLOR', 'Amlodipine', '5mg', 'COMP', 'BTE 30',
        ]);
    }
}
