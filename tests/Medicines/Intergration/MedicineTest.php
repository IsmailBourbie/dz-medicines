<?php

namespace Tests\Medicines\Intergration;

use Database\Factories\CodeFactory;
use Database\Factories\MedicineClassFactory;
use Database\Factories\MedicineFactory;
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
    public function it_get_related_medicines_based_on_class(): void
    {
        $class = MedicineClassFactory::new()->createOne();
        $code = CodeFactory::new()->for($class)->createOne();
        $medicine = MedicineFactory::new()->createOne(['code_id' => $code, 'label' => 'amlor 5mg']);
        $relatedMedicines = MedicineFactory::new()->for($code)->count(2)
            ->state(new Sequence(fn($sequence) => ['label' => 'medicine_'.$sequence->index]))
            ->create();

        $classRelatedMedicines = $medicine->classRelatedMedicines();

        $this->assertCount(2, $classRelatedMedicines);

        $this->assertContains($relatedMedicines->first()->label,
            $classRelatedMedicines->pluck('label')->toArray());
        $this->assertContains($relatedMedicines->last()->label, $classRelatedMedicines->pluck('label')->toArray());
        $this->assertNotContains($medicine->label, $classRelatedMedicines->pluck('label')->toArray());

    }

    #[Test]
    public function it_get_related_medicines_based_on_class_with_different_codes(): void
    {
        $class = MedicineClassFactory::new()->createOne();
        $codeOne = CodeFactory::new()->for($class)->createOne();
        $codeTwo = CodeFactory::new()->for($class)->createOne();
        $medicine = MedicineFactory::new()->createOne(['code_id' => $codeOne, 'label' => 'amlor 5mg']);
        $relatedMedicines = MedicineFactory::new()->for($codeTwo)->count(2)
            ->state(new Sequence(fn($sequence) => ['label' => 'medicine_'.$sequence->index]))
            ->create();

        $classRelatedMedicines = $medicine->classRelatedMedicines();


        $this->assertContains(
            $relatedMedicines->first()->label,
            $classRelatedMedicines->pluck('label')->toArray()
        );
        $this->assertContains(
            $relatedMedicines->last()->label,
            $classRelatedMedicines->pluck('label')->toArray()
        );

    }

    #[Test]
    public function it_get_generics_medicines(): void
    {
        $code = CodeFactory::new()->createOne();

        $medicine = MedicineFactory::new()->for($code)->createOne();
        $generics = MedicineFactory::new()->count(2)->for($code)->create();

        $otherMedicine = MedicineFactory::new()->createOne();

        $this->assertCount(2, $medicine->generics());
        $this->assertTrue($medicine->generics()->contains($generics->first()));
        $this->assertTrue($medicine->generics()->contains($generics->last()));
        $this->assertTrue($medicine->generics()->doesntContain($otherMedicine));

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
    public function it_has_a_class_through_code(): void
    {
        $class = MedicineClassFactory::new()->createOne();
        $codes = CodeFactory::new()->count(2)->for($class)->create();
        $medicine = MedicineFactory::new()->createOne(['code_id' => $codes->last()]);

        $this->assertNotNull($medicine->class);
        $this->assertTrue($medicine->class->is($class));
    }

}
