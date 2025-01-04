<?php

namespace Tests\Medicines\Feature;

use Database\Factories\CodeFactory;
use Database\Factories\LaboratoryFactory;
use Database\Factories\MedicineClassFactory;
use Database\Factories\MedicineFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicinesControllerTest extends TestCase
{

    #[Test]
    public function it_render_index_page_successfully(): void
    {
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
            'amlor', 'amlodipine', '5mg', 'comp', 'BTE 30',
            'exval', 'amlodipine/valsartan', '5mg/80mg', 'comp', 'BTE 30',
        ]);
    }

    #[Test]
    public function it_show_10_medicines_per_page_using_pagination(): void
    {
        MedicineFactory::new()->count(11)->state(new Sequence(
            fn($sequence) => ['name' => 'medicine_'.$sequence->index]
        ))->create();

        $response = $this->get(route('medicines.index'));

        $response->assertSeeText('Results: 11');
        $response->assertSeeText(['medicine_0', 'medicine_4', 'medicine_9']);
        $response->assertDontSeeText(['medicine_10']);
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
            'amlor', 'amlodipine',
            '5mg',
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
    public function it_show_the_class_name(): void
    {
        $class = MedicineClassFactory::new()->createOne(['name' => 'cardiology']);
        $code = CodeFactory::new()->for($class)->createOne();

        $amlor = MedicineFactory::new()
            ->for($code)
            ->createOne(['name' => 'amlor']);

        $response = $this->get($amlor->path());

        $response->assertSeeText('cardiology');
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

    #[Test]
    public function it_show_empty_state_for_not_founding_same_lab_medicines(): void
    {
        $phizer = LaboratoryFactory::new()->createOne(['name' => 'phizer', 'country' => 'france']);
        $amlor = MedicineFactory::new()
            ->for($phizer)
            ->createOne(['label' => 'amlor 5mg', 'name' => 'amlor', 'is_local' => false]);

        $response = $this->get($amlor->path());

        $response->assertViewHas('same_lab_medicines', function ($same_lab_medicines) {
            return $same_lab_medicines->isEmpty();
        });
        $response->assertSeeText('No medicines from this lab.');
    }

    #[Test]
    public function it_show_related_medicines_based_on_class(): void
    {
        $medicines = MedicineFactory::new()
            ->for(CodeFactory::new())
            ->count(3)
            ->state(new Sequence(fn($sequence) => ['label' => 'medicine_'.$sequence->index]))
            ->create();

        $response = $this->get($medicines->first()->path());

        $response->assertViewHas('related_medicines');
        $response->assertSeeText(['MEDICINE_0', 'MEDICINE_1']);

    }

    #[Test]
    public function it_show_empty_state_for_not_founding_related_medicines(): void
    {
        $medicine = MedicineFactory::new()
            ->for(CodeFactory::new())
            ->state(new Sequence(fn($sequence) => ['label' => 'medicine_'.$sequence->index]))
            ->createOne();

        $response = $this->get($medicine->first()->path());

        $response->assertSeeText('No related medicines');

    }

    #[Test]
    public function it_show_generics_medicines(): void
    {
        $medicines = MedicineFactory::new()
            ->for(CodeFactory::new())
            ->count(3)
            ->state(new Sequence(fn($sequence) => ['label' => 'medicine_'.$sequence->index]))
            ->create();

        $response = $this->get($medicines->first()->path());

        $response->assertViewHas('generics');
        $response->assertSeeText($medicines->skip(1)->pluck('label')->toArray());

    }

}
