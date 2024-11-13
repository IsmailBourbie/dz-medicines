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
        $this->withoutExceptionHandling();
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

        $response->assertSee($medicines->pluck('name')->toArray());
    }

    #[Test]
    public function it_show_medicines_with_their_dci(): void
    {
        $this->withoutExceptionHandling();
        $dci = DciFactory::new()->createOne();
        $medicine = MedicineFactory::new()->createOne();

        $medicine->dci()->attach($dci, [
            'form' => 'COMP',
            'dosage' => '1000mg',
            'packaging' => 'bte 8',
        ]);

        $response = $this->get(route('medicines.index'));

        $response->assertSee($medicine->name);
        $response->assertSee($medicine->dci->first()->name);
    }

    #[Test]
    public function it_show_medicines_with_form_and_dose_and_packaging(): void
    {
        $dci = DciFactory::new()->createOne(['name' => 'paracetamol']);
        $medicine = MedicineFactory::new()->createOne(['name' => 'Doliprane']);

        $medicine->dci()->attach($dci, [
            'form' => 'COMP',
            'dosage' => '1000mg',
            'packaging' => '8',
        ]);

        $response = $this->get(route('medicines.index'));

        $response->assertSee($medicine->dci->first()->details->form);
        $response->assertSee($medicine->dci->first()->details->dosage);
        $response->assertSee($medicine->dci->first()->details->packaging);
    }

    #[Test]
    public function it_show_medicine_with_combined_dci(): void
    {
        $amlodipine = DciFactory::new()->createOne(['name' => 'amlodipine']);
        $valsartan = DciFactory::new()->createOne(['name' => 'valsartan']);
        $medicine = MedicineFactory::new()->createOne(['name' => 'exval']);

        $medicine->dci()->attach($amlodipine, [
            'form' => 'COMP',
            'dosage' => '5mg',
            'packaging' => 'Bte 30',
        ]);
        $medicine->dci()->attach($valsartan, [
            'form' => 'COMP',
            'dosage' => '80mg',
            'packaging' => 'Bte 30',
        ]);

        $response = $this->get(route('medicines.index'));

        $response->assertSee($medicine->name);
        $response->assertSee($medicine->dci->first()->name);
        $response->assertSee($medicine->dci->last()->name);
    }

    #[Test]
    public function it_show_medicine_on_formatted_way(): void
    {
        $amlodipine = DciFactory::new()->createOne(['name' => 'amlodipine']);
        $valsartan = DciFactory::new()->createOne(['name' => 'valsartan']);

        $exval = MedicineFactory::new()->createOne(['name' => 'exval']);
        $amlor = MedicineFactory::new()->createOne(['name' => 'amlor']);

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
        $amlor->dci()->attach($valsartan, [
            'form' => 'COMP',
            'dosage' => '5mg',
            'packaging' => 'Bte 30',
        ]);

        $response = $this->get(route('medicines.index'));

//        $response->assertSee('exval (amlodipine/valsartan) 5mg/80mg COMP Bte 30');
//        $response->assertSee('amlor (amlodipine) 5mg COMP Bte 30');
    }
}
