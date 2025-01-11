<?php

namespace Tests\Medicines\Integration;

use App\Medicines\ViewModels\MedicineShowViewModel;
use Database\Factories\CodeFactory;
use Database\Factories\LaboratoryFactory;
use Database\Factories\MedicineClassFactory;
use Database\Factories\MedicineFactory;
use Domains\Medicines\Models\Medicine;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Responsable;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicineShowViewModelTest extends TestCase
{
    #[Test]
    public function it_has_medicine(): void
    {
        $medicine = MedicineFactory::new()->createOne();
        $vieModel = new MedicineShowViewModel($medicine);

        $this->assertInstanceOf(Medicine::class, $vieModel->medicine);
        $this->assertTrue($medicine->is($vieModel->medicine));
        $this->assertInstanceOf(Arrayable::class, $vieModel);
        $this->assertInstanceOf(Responsable::class, $vieModel);
    }

    #[Test]
    public function it_has_related_medicines_by_laboratory(): void
    {
        $laboratory = LaboratoryFactory::new()->createOne(['id' => 12]);
        $medicines = MedicineFactory::new()->for($laboratory)->count(3)->create();
        $otherMedicine = MedicineFactory::new()->createOne();

        $vieModel = new MedicineShowViewModel($medicines[0]);

        $this->assertCount(2, $vieModel->labMedicines());
        $this->assertNotTrue($vieModel->labMedicines()->contains($otherMedicine));
    }

    #[Test]
    public function it_has_related_medicines_by_class(): void
    {
        $class = MedicineClassFactory::new()->createOne(['id' => 23]);
        $code = CodeFactory::new()->for($class)->createOne(['id' => 34]);
        $medicines = MedicineFactory::new()->for($code)->count(3)->create();
        $otherMedicine = MedicineFactory::new()->createOne();

        $vieModel = new MedicineShowViewModel($medicines[0]);

        $this->assertCount(2, $vieModel->classMedicines());
        $this->assertNotTrue($vieModel->classMedicines()->contains($otherMedicine));
    }

    #[Test]
    public function it_has_generics_medicines_by_code(): void
    {
        $code = CodeFactory::new()->createOne(['id' => 56]);
        $medicines = MedicineFactory::new()->for($code)->count(3)->create();
        $otherMedicine = MedicineFactory::new()->createOne();

        $vieModel = new MedicineShowViewModel($medicines[0]);

        $this->assertCount(2, $vieModel->generics());
        $this->assertNotTrue($vieModel->generics()->contains($otherMedicine));
    }
}
