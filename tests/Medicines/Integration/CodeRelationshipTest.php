<?php

namespace Tests\Medicines\Integration;

use Database\Factories\CodeFactory;
use Database\Factories\MedicineClassFactory;
use Domains\Medicines\Models\MedicineClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CodeRelationshipTest extends TestCase
{

    #[Test]
    public function it_belongs_to_class(): void
    {
        $class = MedicineClassFactory::new()->createOne(['name' => 'cardiology']);
        $code = CodeFactory::new()->createOne(['class_id' => $class]);

        $this->assertNotNull($code->class);
        $this->assertInstanceOf(MedicineClass::class, $code->class);
        $this->assertTrue($code->class->is($class));
    }
}
