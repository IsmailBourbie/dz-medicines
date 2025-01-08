<?php

namespace Tests\Medicines\Integration;

use Database\Factories\CodeFactory;
use Database\Factories\LaboratoryFactory;
use Database\Factories\MedicineClassFactory;
use Database\Factories\MedicineFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicineRelationshipTest extends TestCase
{

    #[Test]
    public function it_has_many_class_medicines(): void
    {
        $class = MedicineClassFactory::new()->createOne(['id' => 1234]);
        $code = CodeFactory::new()->for($class)->createOne(['id' => 1234]);

        $medicine = MedicineFactory::new()->for($code)->createOne();
        $sameClassMedicines = MedicineFactory::new()->for($code)->count(2)->create();
        $otherMedicine = MedicineFactory::new()->createOne();

        $this->assertCount(2, $medicine->classMedicines);
        $this->assertTrue($medicine->classMedicines->contains($sameClassMedicines->get(0)));
        $this->assertTrue($medicine->classMedicines->contains($sameClassMedicines->get(1)));
        $this->assertTrue($medicine->classMedicines->doesntContain($otherMedicine));
    }

    #[Test]
    public function it_has_many_class_medicines_with_different_codes(): void
    {
        $class = MedicineClassFactory::new()->createOne();
        $codeOne = CodeFactory::new()->for($class)->createOne();
        $codeTwo = CodeFactory::new()->for($class)->createOne();

        $medicine = MedicineFactory::new()->for($codeOne)->createOne();
        MedicineFactory::new()->for($codeTwo)->count(2)->create();

        $this->assertCount(2, $medicine->classMedicines);
    }

    #[Test]
    public function it_has_many_lab_medicines(): void
    {
        $laboratory = LaboratoryFactory::new()->createOne(['id' => 1234]); // Different id for medicine id

        $medicine = MedicineFactory::new()->for($laboratory)->createOne();
        $medicinesFromSameLab = MedicineFactory::new()->count(2)->for($laboratory)->create();
        $otherMedicine = MedicineFactory::new()->createOne();

        $this->assertCount(2, $medicine->labMedicines);
        $this->assertTrue($medicine->labMedicines->contains($medicinesFromSameLab->get(0)));
        $this->assertTrue($medicine->labMedicines->contains($medicinesFromSameLab->get(1)));
        $this->assertTrue($medicine->labMedicines->doesntContain($otherMedicine));

    }

    #[Test]
    public function it_has_many_generics_medicines(): void
    {
        $code = CodeFactory::new()->createOne(['id' => 2024]); // Different id for medicine id

        $medicine = MedicineFactory::new()->for($code)->createOne();
        $generics = MedicineFactory::new()->count(2)->for($code)->create();
        $otherMedicine = MedicineFactory::new()->createOne();

        $this->assertCount(2, $medicine->generics);
        $this->assertTrue($medicine->generics->contains($generics->get(0)));
        $this->assertTrue($medicine->generics->contains($generics->get(1)));
        $this->assertTrue($medicine->generics->doesntContain($otherMedicine));

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
