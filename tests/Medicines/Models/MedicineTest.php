<?php

namespace Tests\Medicines\Models;

use Database\Factories\CodeFactory;
use Database\Factories\MedicineFactory;
use Database\Factories\SpecialityFactory;
use Domains\Medicines\Models\Medicine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicineTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_has_path_based_on_slug(): void
    {
        $medicine = new Medicine(['slug' => 'hello-world']);

        $this->assertEquals('/medicines/hello-world', $medicine->path());
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
        $code = CodeFactory::new()->for($speciality)->createOne();
        $medicine = MedicineFactory::new()->createOne(['code_id' => $code]);
        
        $this->assertNotNull($medicine->speciality);
        $this->assertTrue($medicine->speciality->is($speciality));
    }

}
