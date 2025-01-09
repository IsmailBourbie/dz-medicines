<?php

namespace Tests\Medicines\Integration;

use Database\Factories\CodeFactory;
use Database\Factories\LaboratoryFactory;
use Database\Factories\MedicineClassFactory;
use Database\Factories\MedicineFactory;
use Domains\Medicines\Models\Code;
use Domains\Medicines\Models\Laboratory;
use Domains\Medicines\Models\MedicineClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicineRelationshipsTest extends TestCase
{
    public Laboratory $laboratory;
    public MedicineClass $class;
    public Code $code;

    public function setUp(): void
    {
        parent::setUp();
        $this->laboratory = LaboratoryFactory::new()->createOne(['id' => 12]);
        $this->class = MedicineClassFactory::new()->createOne(['id' => 34]);
        $this->code = CodeFactory::new()->for($this->class)->createOne(['id' => 56]);
    }


    #[Test]
    public function it_belongs_to_code(): void
    {
        $medicine = MedicineFactory::new()->createOne(['code_id' => $this->code]);

        $this->assertNotNull($medicine->code);
        $this->assertTrue($medicine->code->is($this->code));
    }


    #[Test]
    public function it_belongs_to_laboratory(): void
    {
        $medicine = MedicineFactory::new()->for($this->laboratory)->createOne();

        $this->assertNotNull($medicine->laboratory);
        $this->assertTrue($medicine->laboratory->is($this->laboratory));
    }

    #[Test]
    public function it_has_a_class_through_code(): void
    {
        $medicine = MedicineFactory::new()->for($this->code)->createOne();

        $this->assertNotNull($medicine->class);
        $this->assertTrue($medicine->class->is($this->class));
    }


}
