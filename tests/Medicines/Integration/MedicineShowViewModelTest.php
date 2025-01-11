<?php

namespace Tests\Medicines\Integration;

use Database\Factories\CodeFactory;
use Database\Factories\LaboratoryFactory;
use Database\Factories\MedicineClassFactory;
use Database\Factories\MedicineFactory;
use Domains\Medicines\Models\Medicine;
use Domains\Medicines\ViewModels\MedicineShowViewModel;
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
    }

    #[Test]
    public function it_has_related_medicines_by_laboratory(): void
    {
        $laboratory = LaboratoryFactory::new()->createOne(['id' => 12]);
        $medicines = MedicineFactory::new()->for($laboratory)->count(3)->create();
        $otherMedicine = MedicineFactory::new()->createOne();

        $vieModel = new MedicineShowViewModel($medicines[0]);

        $this->assertCount(2, $vieModel->labMedicines());
        $this->assertTrue($vieModel->labMedicines()->contains($medicines[1]));
        $this->assertTrue($vieModel->labMedicines()->contains($medicines[2]));
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
        $this->assertTrue($vieModel->classMedicines()->contains($medicines[1]));
        $this->assertTrue($vieModel->classMedicines()->contains($medicines[2]));
        $this->assertNotTrue($vieModel->classMedicines()->contains($otherMedicine));
    }

    #[Test]
    public function it_has_related_medicines_by_class_with_different_code(): void
    {
        $class = MedicineClassFactory::new()->createOne(['id' => 23]);
        $codeOne = CodeFactory::new()->for($class)->createOne(['id' => 34]);
        $codeTwo = CodeFactory::new()->for($class)->createOne(['id' => 45]);
        $medicines = MedicineFactory::new()->for($codeOne)->count(2)->create();
        $otherMedicineSameCode = MedicineFactory::new()->for($codeTwo)->createOne();

        $vieModel = new MedicineShowViewModel($medicines[0]);

        $this->assertCount(2, $vieModel->classMedicines());
        $this->assertTrue($vieModel->classMedicines()->contains($otherMedicineSameCode));
    }
}
