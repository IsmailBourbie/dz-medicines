<?php

namespace Tests\Medicines\Intergration;

use Database\Factories\CodeFactory;
use Database\Factories\MedicineClassFactory;
use Database\Factories\MedicineFactory;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicineClassTest extends TestCase
{

    #[Test]
    public function it_has_a_many_medicines_through_code(): void
    {
        $class = MedicineClassFactory::new()->createOne();
        $code = CodeFactory::new()->for($class)->createOne();
        $medicine = MedicineFactory::new()->createOne(['code_id' => $code]);
        MedicineFactory::new()->count(3)->create(['code_id' => $code]);

        $this->assertNotNull($class->medicines);
        $this->assertCount(4, $class->medicines);
        $this->assertInstanceOf(Collection::class, $class->medicines);
        $this->assertTrue($class->medicines->first()->is($medicine));
    }

}
