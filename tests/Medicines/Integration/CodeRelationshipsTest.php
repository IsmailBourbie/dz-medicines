<?php

namespace Tests\Medicines\Integration;

use Database\Factories\CodeFactory;
use Database\Factories\MedicineClassFactory;
use Database\Factories\MedicineFactory;
use Domains\Medicines\Models\MedicineClass;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CodeRelationshipsTest extends TestCase
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

    #[Test]
    public function it_has_many_medicines(): void
    {
        $code = CodeFactory::new()->createOne();
        $medicines = MedicineFactory::new()->count(2)->for($code)->create();

        $this->assertInstanceOf(Collection::class, $code->medicines);
        $this->assertCount(2, $code->medicines);
        $this->assertTrue($medicines[0]->code->is($code));
        $this->assertTrue($medicines[1]->code->is($code));
    }
}
