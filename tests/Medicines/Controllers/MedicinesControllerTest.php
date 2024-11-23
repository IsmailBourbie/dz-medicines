<?php

namespace Tests\Medicines\Controllers;

use Database\Factories\DciFactory;
use Database\Factories\LaboratoryFactory;
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
        $this->withoutExceptionHandling();
        $response = $this->get(route('medicines.index'));

        $response->assertStatus(200);
        $response->assertViewIs('medicines.index');
    }

    #[Test]
    public function it_show_all_existed_medicines_names(): void
    {
        $this->withoutExceptionHandling();
        $medicines = MedicineFactory::new()->count(5)->withDci()->create();
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

        MedicineFactory::new(['packaging' => 'BTE 30', 'form' => 'COMP'])
            ->withDci($amlodipine, '5mg')
            ->withDci($valsartan, '80mg')
            ->createOne(['name' => 'exval']);
        MedicineFactory::new(['packaging' => 'BTE 30', 'form' => 'COMP'])
            ->withDci($amlodipine, '5mg')->createOne(['name' => 'amlor']);

        $response = $this->get(route('medicines.index'));

        $response->assertSeeTextInOrder([
            'EXVAL', 'Amlodipine/Valsartan', '5mg/80mg', 'COMP', 'BTE 30',
        ]);
        $response->assertSeeTextInOrder([
            'AMLOR', 'Amlodipine', '5mg', 'COMP', 'BTE 30',
        ]);
    }

    #[Test]
    public function it_show_10_medicines_per_page_using_pagination(): void
    {
        $medicines = MedicineFactory::new()->count(40)->withDci()->create();

        $response = $this->get(route('medicines.index'));

        $response->assertSeeText('40');
        $response->assertSeeText($medicines->take(10)->pluck('name')->map(fn($str) => strtoupper($str))->toArray());
        $response->assertDontSeeText(strtoupper($medicines->get(10)->name));
    }

    #[Test]
    public function it_show_a_medicine_details_page_successfully_with_all_information(): void
    {
        $this->withoutExceptionHandling();
        $amlodipine = DciFactory::new()->createOne(['name' => 'amlodipine']);
        $amlor = MedicineFactory::new(['packaging' => 'BTE 30', 'form' => 'COMP'])
            ->withDci($amlodipine, '5mg')->createOne(['name' => 'amlor']);

        $response = $this->get($amlor->path())->assertSuccessful();

        $response->assertSuccessful();
        $response->assertViewIs('medicines.show');
        $response->assertViewHas('medicine');
        $response->assertSeeTextInOrder([
            'AMLOR 5MG COMP BTE 30', 'AMLOR', 'Amlodipine', '5mg', 'COMP', 'BTE 30',
        ]);

        $response->assertSeeTextInOrder([
        ]);
    }

    #[Test]
    public function it_show_combined_medicine_page_successfully(): void
    {
        $this->withoutExceptionHandling();
        $amlodipine = DciFactory::new()->createOne(['name' => 'amlodipine']);
        $valsartan = DciFactory::new()->createOne(['name' => 'valsartan']);

        $exval = MedicineFactory::new(['packaging' => 'BTE 30', 'form' => 'COMP'])
            ->withDci($amlodipine, '5mg')->withDci($valsartan,
                '80mg')->createOne(['name' => 'exval']);

        $response = $this->get($exval->path());

        $response->assertSuccessful();
        $response->assertViewIs('medicines.show');
        $response->assertViewHas('medicine');
        $response->assertSeeTextInOrder([
            'EXVAL', 'Amlodipine/Valsartan', '5mg/80mg', 'COMP', 'BTE 30',
        ]);
    }

    #[Test]
    public function it_show_the_detail_of_medicine_laboratory(): void
    {
        $phizer = LaboratoryFactory::new()->createOne(['name' => 'phizer', 'country' => 'france']);
        $amlor = MedicineFactory::new()
            ->for($phizer)
            ->createOne(['name' => 'amlor']);

        $response = $this->get($amlor->path());

        $response->assertSeeText('phizer');
        $response->assertSeeText('France');
    }
}
