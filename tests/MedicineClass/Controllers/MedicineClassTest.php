<?php

namespace Tests\MedicineClass\Controllers;

use Database\Factories\MedicineClassFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicineClassTest extends TestCase
{
    #[Test]
    public function it_show_laboratory_page(): void
    {
        $class = MedicineClassFactory::new()->createOne();

        $response = $this->get(route('classes.show', $class));

        $response->assertSuccessful();
        $response->assertViewIs('classes.show');
        $response->assertViewHas('class');
        $response->assertSeeText([$class->name]);

    }
}
