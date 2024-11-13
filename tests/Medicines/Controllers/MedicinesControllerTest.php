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
}
