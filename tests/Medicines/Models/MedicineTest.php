<?php

namespace Tests\Medicines\Models;

use Database\Factories\CodeFactory;
use Database\Factories\LaboratoryFactory;
use Database\Factories\MedicineFactory;
use Domains\Medicines\Models\Laboratory;
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
        $dci = CodeFactory::new()->createOne([
            'name' => 'paracetamol',
        ]);
        $medicine = MedicineFactory::new()->withDci($dci, '1000mg')->createOne();

        $this->assertInstanceOf(Collection::class, $medicine->dci);
        $this->assertCount(1, $medicine->dci);
        $this->assertEquals($dci->id, $medicine->dci->first()->id);
        $this->assertEqualsIgnoringCase('paracetamol', $medicine->dci->first()->name);
    }

    #[Test]
    public function it_belongs_to_laboratory(): void
    {
        $laboratory = LaboratoryFactory::new()->createOne();
        $medicine = MedicineFactory::new()->createOne(['laboratory_id' => $laboratory]);

        $this->assertInstanceOf(Laboratory::class, $medicine->laboratory);
        $this->assertTrue($medicine->laboratory->is($laboratory));
    }

    #[Test]
    public function it_has_pivot_data_on_dci_relation(): void
    {
        $dci = CodeFactory::new()->createOne([
            'name' => 'paracetamol',
        ]);
        $medicine = MedicineFactory::new()->withDci($dci, '1000mg')->createOne();

        $this->assertEquals('1000mg', $medicine->dci->first()->details->dosage);
    }

    #[Test]
    public function it_load_dci_relation_by_default(): void
    {
        $dci = CodeFactory::new()->createOne();
        $medicine = MedicineFactory::new()->withDci($dci, '1000mg')->createOne();

        $freshMedicine = Medicine::find($medicine);

        $this->assertArrayHasKey('dci', $freshMedicine->first()->toArray());
    }

    #[Test]
    public function it_format_dci_and_dosage(): void
    {
        $amlodipine = CodeFactory::new()->createOne(['name' => 'amlodipine']);
        $valsartan = CodeFactory::new()->createOne(['name' => 'valsartan']);
        $exval = MedicineFactory::new()
            ->withDci($amlodipine, '5mg')
            ->withDci($valsartan, '80mg')
            ->createOne(['name' => 'exval']);

        $amlor = MedicineFactory::new()->withDci($amlodipine, '5mg')->createOne(['name' => 'amlor']);

        $this->assertEquals('Amlodipine/Valsartan', $exval->displayDci());
        $this->assertEquals('Amlodipine', $amlor->displayDci());

        $this->assertEquals('5mg/80mg', $exval->displayDosage());
        $this->assertEquals('5mg', $amlor->displayDosage());
    }

    #[Test]
    public function it_has_path_based_on_slug(): void
    {
        $medicine = MedicineFactory::new(['slug' => 'hello-world'])
            ->withDci()
            ->createOne();

        $this->assertEquals(url('medicines/hello-world'), $medicine->path());
    }

    #[Test]
    public function it_has_fullName(): void
    {
        $medicine = MedicineFactory::new()->withDci(dosage: '5mg')->createOne([
            'full_name' => 'doliprane 5mg comp bte 30 secable',
            'name' => 'doliprane',
            'form' => 'COMP',
            'packaging' => 'bte 30',
        ]);
        $this->assertEquals('DOLIPRANE 5MG COMP BTE 30 SECABLE', $medicine->full_name);
    }
}
