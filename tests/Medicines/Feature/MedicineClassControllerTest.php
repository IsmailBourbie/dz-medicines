<?php

namespace Tests\Medicines\Feature;

use Database\Factories\CodeFactory;
use Database\Factories\MedicineClassFactory;
use Database\Factories\MedicineFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicineClassControllerTest extends TestCase
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

    #[Test]
    public function it_use_pagination_to_show_ten_medicine_per_page(): void
    {
        $class = MedicineClassFactory::new()->createOne();
        $code = CodeFactory::new()->for($class)->createOne();
        $medicines = MedicineFactory::new()->for($code)
            ->count(11)
            ->state(new Sequence(
                fn($sequence) => ['name' => 'medicine_'.$sequence->index]
            ))
            ->create();


        $response = $this->get(route('classes.show', $class));

        $response->assertSeeText([
            'medicine_0',
            'medicine_9',
        ]);
        $response->assertDontSeeText('medicine_10');

    }
}
