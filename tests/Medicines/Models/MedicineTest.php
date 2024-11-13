<?php

namespace Tests\Medicines\Models;

use Database\Factories\DciFactory;
use Database\Factories\MedicineFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicineTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_belongs_to_many_dci(): void
    {
        $dci = DciFactory::new()->createOne([
            'name' => 'paracetamol',
        ]);
        $medicine = MedicineFactory::new()->createOne();

        $medicine->dci()->attach($dci, [
            'form' => 'COMP',
            'dosage' => '1000mg',
            'packaging' => 'Bte/8',
        ]);

        $this->assertInstanceOf(Collection::class, $medicine->dci);
        $this->assertCount(1, $medicine->dci);
        $this->assertEquals($dci->id, $medicine->dci->first()->id);
        $this->assertEquals('paracetamol', $medicine->dci->first()->name);
    }

    #[Test]
    public function it_has_pivot_data_on_dci_relation(): void
    {
        $dci = DciFactory::new()->createOne([
            'name' => 'paracetamol',
        ]);
        $medicine = MedicineFactory::new()->createOne();

        $medicine->dci()->attach($dci, [
            'form' => 'COMP',
            'dosage' => '1000mg',
            'packaging' => '8',
        ]);

        $this->assertEquals('COMP', $medicine->dci->first()->details->form);
        $this->assertEquals('1000mg', $medicine->dci->first()->details->dosage);
        $this->assertEquals('8', $medicine->dci->first()->details->packaging);

    }
}
