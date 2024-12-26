<?php

namespace Tests\Medicines\Controllers;

use Database\Factories\LaboratoryFactory;
use Database\Factories\MedicineFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicinesControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_render_index_page_successfully(): void
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('medicines.index'));

        $response->assertStatus(200);
        $response->assertViewIs('medicines.index');
    }

    #[Test]
    public function it_show_all_existed_medicines_names_with_full_details(): void
    {
        $this->withoutExceptionHandling();
        $medicine1 = MedicineFactory::new()->create([
            'name' => 'amlor',
            'dci' => 'amlodipine',
            'dosage' => '5mg',
            'form' => 'comp',
            'packaging' => 'BTE 30',
        ]);
        $medicine2 = MedicineFactory::new()->create([
            'name' => 'exval',
            'dci' => 'amlodipine/valsartan',
            'dosage' => '5mg/80mg',
            'form' => 'comp',
            'packaging' => 'BTE 30',
        ]);

        $response = $this->get(route('medicines.index'));

        $response->assertSeeText([
            'AMLOR', 'AMLODIPINE', '5MG', 'COMP', 'BTE 30',
            'EXVAL', 'AMLODIPINE/VALSARTAN', '5MG/80MG', 'COMP', 'BTE 30',
        ]);
    }

    #[Test]
    public function it_show_10_medicines_per_page_using_pagination(): void
    {
        $this->withoutExceptionHandling();
        $medicines = MedicineFactory::new()->count(40)->create();

        $response = $this->get(route('medicines.index'));

        $response->assertSeeText('40');
        $response->assertSeeText([$medicines->get(0)->name, $medicines->get(9)->name]);
        $response->assertDontSeeText(strtoupper($medicines->get(10)->name));
    }

    #[Test]
    public function it_show_a_medicine_details_page_successfully_with_all_information(): void
    {
        $this->withoutExceptionHandling();
        $amlor = MedicineFactory::new()->createOne([
            'label' => 'amlor 5mg COMP bte 30',
            'name' => 'amlor',
            'dci' => 'amlodipine',
            'dosage' => '5mg',
            'form' => 'COMP',
            'packaging' => 'BTE 30',
            'is_generic' => false,
        ]);

        $response = $this->get($amlor->path());

        $response->assertSuccessful();
        $response->assertViewIs('medicines.show');
        $response->assertViewHas('medicine');
        $response->assertSeeTextInOrder([
            'AMLOR 5MG COMP BTE 30',
            'AMLOR', 'AMLODIPINE',
            '5MG',
            'COMP',
            'BTE 30',
            'Innovator',
        ]);
    }

    #[Test]
    public function it_show_the_detail_of_medicine_laboratory(): void
    {
        $phizer = LaboratoryFactory::new()->createOne(['name' => 'phizer', 'country' => 'france']);
        $amlor = MedicineFactory::new()
            ->for($phizer)
            ->createOne(['name' => 'amlor', 'is_local' => false]);

        $response = $this->get($amlor->path());

        $response->assertSeeText('PHIZER');
        $response->assertSeeText('France');
        $response->assertSeeText('Foreign');
    }

    #[Test]
    public function it_show_other_medicine_form_the_same_laboratory(): void
    {
        $this->withoutExceptionHandling();
        $phizer = LaboratoryFactory::new()->createOne(['name' => 'phizer', 'country' => 'france']);

        MedicineFactory::new()
            ->for($phizer)
            ->count(2)
            ->state(new Sequence(fn($sequence) => ['label' => 'medicine_'.$sequence->index]))
            ->create();
        $amlor = MedicineFactory::new()
            ->for($phizer)
            ->createOne(['label' => 'amlor 5mg', 'name' => 'amlor', 'is_local' => false]);

        $response = $this->get($amlor->path());

        $response->assertViewHas('same_lab_medicines', function ($same_lab_medicines) {
            return $same_lab_medicines->contains('label', 'MEDICINE_0') &&
                $same_lab_medicines->contains('label', 'MEDICINE_1') &&
                $same_lab_medicines->doesntContain('label', 'AMLOR 5MG');
        });
        $response->assertSeeText(['MEDICINE_0', 'MEDICINE_1']);
    }
}
