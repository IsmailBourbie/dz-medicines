<?php

namespace Tests\Medicines\Intergration;

use Database\Factories\MedicineFactory;
use Domains\Medicines\Models\Medicine;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicineTest extends TestCase
{
    #[Test]
    public function it_has_scope_to_filter_out_a_medicine(): void
    {
        $medicine = MedicineFactory::new()->createOne();
        MedicineFactory::new()->count(2)->create();
        
        $filteredMedicines = Medicine::query()->filterOutMedicine($medicine->id)->get();

        $this->assertCount(2, $filteredMedicines);
        $this->assertTrue($filteredMedicines->doesntContain($medicine));
    }
}
