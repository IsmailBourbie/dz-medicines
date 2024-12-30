<?php

namespace Tests\Medicines\Models;

use Database\Factories\CodeFactory;
use Database\Factories\MedicineFactory;
use Database\Factories\SpecialityFactory;
use Domains\Medicines\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Sequence;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicineTest extends TestCase
{

    #[Test]
    public function it_has_path_based_on_slug(): void
    {
        $medicine = new Medicine(['slug' => 'hello-world']);

        $this->assertEquals('/medicines/hello-world', $medicine->path());
    }

    #[Test]
    public function it_gets_the_label_as_uppercases_letter(): void
    {
        $medicine = new Medicine(['label' => 'hello world']);

        $this->assertEquals('HELLO WORLD', $medicine->label);

    }

    #[Test]
    public function it_get_related_medicines_based_on_speciality(): void
    {
        $speciality = SpecialityFactory::new()->createOne();
        $code = CodeFactory::new()->for($speciality)->createOne();
        $medicine = MedicineFactory::new()->createOne(['code_id' => $code, 'label' => 'amlor 5mg']);
        $relatedMedicines = MedicineFactory::new()->for($code)->count(2)
            ->state(new Sequence(fn($sequence) => ['label' => 'medicine_'.$sequence->index]))
            ->create();

        $specialityRelatedMedicines = $medicine->specialityRelatedMedicines();

        $this->assertCount(2, $specialityRelatedMedicines);

        $this->assertContains($relatedMedicines->first()->label,
            $specialityRelatedMedicines->pluck('label')->toArray());
        $this->assertContains($relatedMedicines->last()->label, $specialityRelatedMedicines->pluck('label')->toArray());
        $this->assertNotContains($medicine->label, $specialityRelatedMedicines->pluck('label')->toArray());

    }

    #[Test]
    public function it_get_related_medicines_based_on_speciality_with_different_codes(): void
    {
        $speciality = SpecialityFactory::new()->createOne();
        $codeOne = CodeFactory::new()->for($speciality)->createOne();
        $codeTwo = CodeFactory::new()->for($speciality)->createOne();
        $medicine = MedicineFactory::new()->createOne(['code_id' => $codeOne, 'label' => 'amlor 5mg']);
        $relatedMedicines = MedicineFactory::new()->for($codeTwo)->count(2)
            ->state(new Sequence(fn($sequence) => ['label' => 'medicine_'.$sequence->index]))
            ->create();

        $specialityRelatedMedicines = $medicine->specialityRelatedMedicines();


        $this->assertContains(
            $relatedMedicines->first()->label,
            $specialityRelatedMedicines->pluck('label')->toArray()
        );
        $this->assertContains(
            $relatedMedicines->last()->label,
            $specialityRelatedMedicines->pluck('label')->toArray()
        );

    }

    #[Test]
    public function it_belongs_to_code(): void
    {
        $code = CodeFactory::new()->createOne();
        $medicine = MedicineFactory::new()->createOne(['code_id' => $code]);

        $this->assertNotNull($medicine->code);
        $this->assertTrue($medicine->code->is($code));
    }

    #[Test]
    public function it_has_a_speciality_through_code(): void
    {
        $speciality = SpecialityFactory::new()->createOne();
        $codes = CodeFactory::new()->count(2)->for($speciality)->create();
        $medicine = MedicineFactory::new()->createOne(['code_id' => $codes->last()]);

        $this->assertNotNull($medicine->speciality);
        $this->assertTrue($medicine->speciality->is($speciality));
    }

}
