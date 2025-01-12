<?php

namespace Tests\Medicines\Unit;

use Domains\Medicines\Models\Medicine;
use Domains\Medicines\Observers\MedicineObserver;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MedicineObserverTest extends TestCase
{
    #[Test]
    public function it_generate_label_based_on_medicine_detail(): void
    {
        $medicine = new Medicine([
            'name' => 'doliprane',
            'dosage' => '500mg',
            'form' => 'comp',
            'packaging' => 'bte de 10',
        ]);

        $observer = new MedicineObserver();
        $observer->saving($medicine);

        $this->assertEquals('doliprane comp 500mg bte de 10', $medicine->getAttributes()['label']);

    }

    #[Test]
    public function it_generate_slug_based_on_medicine_slug(): void
    {
        $medicine = new Medicine([
            'name' => 'doliprane',
            'dosage' => '500mg',
            'form' => 'comp',
            'packaging' => 'bte de 10',
        ]);

        $observer = new MedicineObserver();
        $observer->saving($medicine);

        $this->assertEquals('doliprane-comp-500mg-bte-de-10', $medicine->slug);

    }
}
