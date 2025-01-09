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

        $response->assertStatus(200)
            ->assertViewIs('medicines.index');
    }

    #[Test]
    public function it_show_all_existed_medicines_names_with_needed_details(): void
    {
        $medicines = MedicineFactory::new()->count(2)->create();

        $response = $this->get(route('medicines.index'));

        $response->assertSeeText([
            $medicines[0]->name, $medicines[0]->dci, $medicines[0]->dosage, $medicines[0]->form,
            $medicines[0]->packaging,
        ])
            ->assertSeeText([
                $medicines[1]->name, $medicines[1]->dci, $medicines[1]->dosage, $medicines[1]->form,
                $medicines[1]->packaging,
            ]);
    }

    #[Test]
    public function it_show_a_medicine_details_page_successfully_with_all_information(): void
    {
        $laboratory = LaboratoryFactory::new()->createOne();
        $class = MedicineClassFactory::new()->createOne();
        $code = CodeFactory::new()->for($class)->createOne();

        $medicine = MedicineFactory::new()->for($code)->for($laboratory)
            ->createOne(['is_generic' => false, 'is_local' => false]);

        $response = $this->get($medicine->path());

        $response->assertSuccessful()
            ->assertViewIs('medicines.show')
            ->assertViewHas(['medicine', 'generics', 'classMedicines', 'labMedicines'])
            ->assertSeeText([
                $medicine->label, $medicine->name, $medicine->dci,
                $medicine->dosage, $medicine->form, $medicine->packaging,
                'Innovator',
            ])
            ->assertSeeText([$laboratory->name, $laboratory->country, 'foreign'])
            ->assertSeeText($class->name);
    }

    #[Test]
    public function it_show_other_medicine_form_the_same_laboratory(): void
    {
        $laboratory = LaboratoryFactory::new()->createOne();

        MedicineFactory::new()
            ->for($laboratory)
            ->count(2)
            ->state(new Sequence(fn($sequence) => ['label' => 'medicine_'.$sequence->index]))
            ->create();
        $medicine = MedicineFactory::new()
            ->for($laboratory)
            ->createOne();

        $response = $this->get($medicine->path());

        $response->assertSeeText(['MEDICINE_0', 'MEDICINE_1'])
            ->assertDontSeeText('No medicines from this lab');
    }

    #[Test]
    public function it_show_empty_state_for_not_founding_same_lab_medicines(): void
    {
        $laboratory = LaboratoryFactory::new()->createOne();
        $medicine = MedicineFactory::new()
            ->for($laboratory)
            ->createOne();

        $response = $this->get($medicine->path());

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

        $response->assertSeeText(['MEDICINE_0', 'MEDICINE_1']);
        $response->assertDontSeeText('No related medicines');

    }

    #[Test]
    public function it_show_empty_state_for_not_founding_related_medicines(): void
    {
        $medicine = MedicineFactory::new()
            ->for(CodeFactory::new())
            ->state(new Sequence(fn($sequence) => ['label' => 'medicine_'.$sequence->index]))
            ->createOne();

        $response = $this->get($medicine->path());

        $response->assertSeeText('No related medicines');
    }

    #[Test]
    public function it_show_generics_medicines(): void
    {
        $medicines = MedicineFactory::new()
            ->for(CodeFactory::new()->createOne())
            ->count(3)
            ->state(new Sequence(fn($sequence) => ['label' => 'medicine_'.$sequence->index]))
            ->create();

        $response = $this->get($medicines->first()->path());

        $response->assertSeeText($medicines->skip(1)->pluck('label')->toArray())
            ->assertDontSeeText('No available generics');

    }

    #[Test]
    public function it_show_empty_state_for_generics_medicines(): void
    {
        $medicines = MedicineFactory::new()
            ->for(CodeFactory::new()->createOne())
            ->createOne();

        $this->get($medicines->path())
            ->assertSeeText('No available generics');

    }

}
