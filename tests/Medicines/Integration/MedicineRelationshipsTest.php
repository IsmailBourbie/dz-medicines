<?php

namespace Tests\Medicines\Integration;

use Database\Factories\CodeFactory;
use Database\Factories\LaboratoryFactory;
use Database\Factories\MedicineClassFactory;
use Database\Factories\MedicineFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicineRelationshipsTest extends TestCase
{

    #[Test]
    public function it_belongs_to_code(): void
    {
        $code = CodeFactory::new()->createOne();
        $medicine = MedicineFactory::new()->createOne(['code_id' => $code]);

        $this->assertNotNull($medicine->code);
        $this->assertTrue($medicine->code->is($code));
    }


    #[Test]
    public function it_belongs_to_laboratory(): void
    {
        $laboratory = LaboratoryFactory::new()->createOne();
        $medicine = MedicineFactory::new()->for($laboratory)->createOne();

        $this->assertNotNull($medicine->laboratory);
        $this->assertTrue($medicine->laboratory->is($laboratory));
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
