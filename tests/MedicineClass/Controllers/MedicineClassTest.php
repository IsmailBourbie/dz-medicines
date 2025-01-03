<?php

namespace Tests\MedicineClass\Controllers;

use Database\Factories\CodeFactory;
use Database\Factories\MedicineClassFactory;
use Database\Factories\MedicineFactory;
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

    #[Test]
    public function it_show_medicines_of_laboratory(): void
    {
        $class = MedicineClassFactory::new()->createOne();
        $code = CodeFactory::new()->for($class)->createOne();
        $medicine = MedicineFactory::new()->for($code)->createOne();

        $response = $this->get(route('classes.show', $class));

        $response->assertSeeText([
            $medicine->name, $medicine->dci,
            $medicine->dosage, $medicine->form,
            $medicine->packaging,
        ]);
    }
}
