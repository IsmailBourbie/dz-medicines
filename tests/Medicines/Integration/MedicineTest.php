<?php

namespace Tests\Medicines\Integration;

use Database\Factories\MedicineFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicineTest extends TestCase
{
    #[Test]
    public function it_generate_label_based_on_medicine_details(): void
    {
        $medicine = MedicineFactory::new()->make([
            'name' => 'doliprane',
            'dosage' => '500mg',
            'form' => 'comp',
            'packaging' => 'bte de 10',
            'label' => null,
        ]);

        $medicine->save();

        $this->assertEquals('doliprane comp 500mg bte de 10', $medicine->getAttributes()['label']);

    }
}
