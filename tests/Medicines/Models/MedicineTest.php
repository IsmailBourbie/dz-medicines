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

        $medicine->dci()->attach($dci);

        $this->assertInstanceOf(Collection::class, $medicine->dci);
        $this->assertCount(1, $medicine->dci);
        $this->assertEquals($dci->id, $medicine->dci->first()->id);
        $this->assertEquals('paracetamol', $medicine->dci->first()->name);
    }
}
