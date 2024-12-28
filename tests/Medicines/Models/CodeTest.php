<?php

namespace Tests\Medicines\Models;

use Database\Factories\CodeFactory;
use Database\Factories\SpecialityFactory;
use Domains\Medicines\Models\Speciality;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CodeTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_belongs_to_speciality(): void
    {
        $speciality = SpecialityFactory::new()->createOne(['name' => 'cardiology']);
        $code = CodeFactory::new()->createOne(['speciality_id' => $speciality]);

        $this->assertNotNull($code->speciality);
        $this->assertInstanceOf(Speciality::class, $code->speciality);
        $this->assertTrue($code->speciality->is($speciality));
    }
}
