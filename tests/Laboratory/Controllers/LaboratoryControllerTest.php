<?php

namespace Tests\Laboratory\Controllers;

use Database\Factories\LaboratoryFactory;
use Database\Factories\MedicineFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LaboratoryControllerTest extends TestCase
{
    #[Test]
    public function it_show_laboratory_page(): void
    {
        $laboratory = LaboratoryFactory::new()->createOne();

        $response = $this->get(route('laboratories.show', $laboratory->id));

        $response->assertSuccessful();
        $response->assertViewIs('laboratories.show');
        $response->assertViewHas('laboratory');
        $response->assertSeeText([$laboratory->name, $laboratory->country]);

    }

    #[Test]
    public function it_show_medicines_of_laboratory(): void
    {
        $laboratory = LaboratoryFactory::new()->createOne();
        $medicine = MedicineFactory::new()->for($laboratory)->createOne();

        $response = $this->get(route('laboratories.show', $laboratory->id));

        $response->assertSeeText([
            $medicine->name, $medicine->dci,
            $medicine->dosage, $medicine->form,
            $medicine->packaging,
        ]);

    }

    #[Test]
    public function it_use_pagination_to_show_ten_medicine_per_page(): void
    {
        $laboratory = LaboratoryFactory::new()->createOne();
        $medicines = MedicineFactory::new()->for($laboratory)->count(11)->create();

        $response = $this->get(route('laboratories.show', $laboratory->id));

        $response->assertSeeText([
            $medicines->get(0)->name,
            $medicines->get(9)->name,
        ]);
        $response->assertSeeText($medicines->get(10)->name);

    }
}
