<?php

namespace Tests\Medicines\Models;

use Database\Factories\CodeFactory;
use Database\Factories\MedicineFactory;
use Database\Factories\SpecialityFactory;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SpecialityTest extends TestCase
{

    #[Test]
    public function it_has_a_many_medicines_through_code(): void
    {
        $speciality = SpecialityFactory::new()->createOne();
        $code = CodeFactory::new()->for($speciality)->createOne();
        $medicine = MedicineFactory::new()->createOne(['code_id' => $code]);
        MedicineFactory::new()->count(3)->create(['code_id' => $code]);

        $this->assertNotNull($speciality->medicines);
        $this->assertCount(4, $speciality->medicines);
        $this->assertInstanceOf(Collection::class, $speciality->medicines);
        $this->assertTrue($speciality->medicines->first()->is($medicine));
    }

}
