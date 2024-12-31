<?php

namespace Tests\Medicines\Models;

use Database\Factories\CodeFactory;
use Database\Factories\MedicineFactory;
use Database\Factories\SpecialityFactory;
use Domains\Medicines\Models\Speciality;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CodeTest extends TestCase
{

    #[Test]
    public function it_belongs_to_speciality(): void
    {
        $speciality = SpecialityFactory::new()->createOne(['name' => 'cardiology']);
        $code = CodeFactory::new()->createOne(['speciality_id' => $speciality]);

        $this->assertNotNull($code->speciality);
        $this->assertInstanceOf(Speciality::class, $code->speciality);
        $this->assertTrue($code->speciality->is($speciality));
    }

    #[Test]
    public function it_has_many_medicines(): void
    {
        $code = CodeFactory::new()->createOne();

        $medicines = MedicineFactory::new()->count(2)->create(['code_id' => $code]);

        $this->assertCount(2, $code->medicines);
        $this->assertInstanceOf(Collection::class, $code->medicines);
        $this->assertTrue($code->medicines->first()->is($medicines->first()));

    }
}
