<?php

namespace Tests\Medicines\Models;

use Database\Factories\DciFactory;
use Database\Factories\MedicineFactory;
use Domains\Medicines\Models\Medicine;
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
            'slug' => 'test-slug',
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
            'slug' => 'test-slug',
            'form' => 'COMP',
            'dosage' => '1000mg',
            'packaging' => '8',
        ]);

        $this->assertEquals('COMP', $medicine->dci->first()->details->form);
        $this->assertEquals('1000mg', $medicine->dci->first()->details->dosage);
        $this->assertEquals('8', $medicine->dci->first()->details->packaging);

    }

    #[Test]
    public function it_load_dci_relation_by_default(): void
    {
        $dci = DciFactory::new()->createOne();
        $medicine = MedicineFactory::new()->createOne();
        $medicine->dci()->attach($dci, [
            'slug' => 'test-slug',
            'form' => 'COMP',
            'dosage' => '1000mg',
            'packaging' => '8',
        ]);

        $freshMedicine = Medicine::find($medicine);

        $this->assertArrayHasKey('dci', $freshMedicine->first()->toArray());
    }

    #[Test]
    public function it_format_dci_and_dosage(): void
    {
        $amlodipine = DciFactory::new()->createOne(['name' => 'amlodipine']);
        $valsartan = DciFactory::new()->createOne(['name' => 'valsartan']);

        $exval = MedicineFactory::new()->createOne(['name' => 'exval']);
        $amlor = MedicineFactory::new()->createOne(['name' => 'amlor']);

        // With Combined DCI
        $exval->dci()->attach($amlodipine, [
            'slug' => 'test-slug',
            'form' => 'COMP',
            'dosage' => '5mg',
            'packaging' => 'Bte 30',
        ]);
        $exval->dci()->attach($valsartan, [
            'slug' => 'test-slug',
            'form' => 'COMP',
            'dosage' => '80mg',
            'packaging' => 'Bte 30',
        ]);
        // With Single Dci
        $amlor->dci()->attach($amlodipine, [
            'slug' => 'another-test-slug',
            'form' => 'COMP',
            'dosage' => '5mg',
            'packaging' => 'Bte 30',
        ]);


        $this->assertEquals($exval->formatted_dci(), 'Amlodipine/Valsartan');
        $this->assertEquals($amlor->formatted_dci(), 'Amlodipine');

        $this->assertEquals($exval->formatted_dosage(), '5mg/80mg');
        $this->assertEquals($amlor->formatted_dosage(), '5mg');
    }

    #[Test]
    public function it_has_path_based_on_slug(): void
    {
        $medicine = MedicineFactory::new()->createOne();
        $dci = DciFactory::new()->createOne();

        $medicine->dci()->attach($dci, [
            'slug' => 'hello-world',
            'form' => 'COMP',
            'dosage' => '1000mg',
            'packaging' => 'BTE 8',
        ]);

        $this->assertEquals(url('medicines/hello-world'), $medicine->path());
    }

    #[Test]
    public function it_find_medicine_with_slug(): void
    {
        $medicine = MedicineFactory::new()->createOne();
        $dci = DciFactory::new()->createOne();

        $medicine->dci()->attach($dci, [
            'slug' => 'hello-world',
            'form' => 'COMP',
            'dosage' => '1000mg',
            'packaging' => 'BTE 8',
        ]);

        $findMedicine = Medicine::query()->whereSlug('hello-world')->get();

        $this->assertInstanceOf(Collection::class, $findMedicine);
        $this->assertTrue($medicine->is($findMedicine->first()));
    }
}
