<?php

namespace Tests\Medicines\Integration;

use Database\Factories\CodeFactory;
use Database\Factories\LaboratoryFactory;
use Database\Factories\MedicineClassFactory;
use Database\Factories\MedicineFactory;
use Domains\Medicines\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicineQueryBuilderTest extends TestCase
{
    #[Test]
    public function it_filter_out_a_medicine(): void
    {
        $medicine = MedicineFactory::new()->createOne();
        MedicineFactory::new()->count(2)->create();

        $filteredMedicines = Medicine::query()->filterOutMedicine($medicine)->get();

        $this->assertCount(2, $filteredMedicines);
        $this->assertTrue($filteredMedicines->doesntContain($medicine));
    }

    #[Test]
    public function it_get_medicines_from_given_laboratory(): void
    {
        $laboratory = LaboratoryFactory::new()->createOne(['id' => 12]);
        $medicines = MedicineFactory::new()->for($laboratory)->count(3)->create();
        $otherMedicine = MedicineFactory::new()->createOne();

        $medicinesFromLab = Medicine::query()->labMedicines($medicines[0]->laboratory)->get();

        $this->assertCount(3, $medicinesFromLab);
        $this->assertTrue($medicinesFromLab->doesntContain($otherMedicine));

    }

    #[Test]
    public function it_get_medicines_from_given_code(): void
    {
        $code = CodeFactory::new()->createOne(['id' => 23]);
        $medicines = MedicineFactory::new()->for($code)->count(3)->create();
        $otherMedicine = MedicineFactory::new()->createOne();

        $medicinesFromCode = Medicine::query()->codeMedicines($medicines[0]->code)->get();

        $this->assertCount(3, $medicinesFromCode);
        $this->assertTrue($medicinesFromCode->doesntContain($otherMedicine));

    }

    #[Test]
    public function it_get_medicines_from_given_class(): void
    {
        $class = MedicineClassFactory::new()->createOne(['id' => 23]);
        $codeOne = CodeFactory::new()->for($class)->createOne(['id' => 34]);
        $codeTwo = CodeFactory::new()->for($class)->createOne(['id' => 45]);

        $medicines = MedicineFactory::new()->for($codeOne)->count(2)->create();
        $differentCodeMedicine = MedicineFactory::new()->for($codeTwo)->createOne();
        $otherMedicine = MedicineFactory::new()->createOne();

        $medicinesFromClass = Medicine::query()->classMedicines($medicines[0]->class)->get();

        $this->assertCount(3, $medicinesFromClass);
        $this->assertTrue($medicinesFromClass->contains($differentCodeMedicine));
        $this->assertTrue($medicinesFromClass->doesntContain($otherMedicine));

    }

    #[Test]
    public function it_search_medicine(): void
    {
        $medicines = MedicineFactory::new()->count(2)->state(new Sequence(
            ['name' => 'first medicine'],
            ['name' => 'second medicine'],
        ))->create();

        $searchResult = Medicine::query()->search('first')->get();

        $this->assertCount(1, $searchResult);
        $this->assertTrue($searchResult->contains($medicines[0]));
        $this->assertTrue($searchResult->doesntContain($medicines[1]));

    }

    #[Test]
    public function it_return_nothing_for_empty_query_without_touching_db(): void
    {
        MedicineFactory::new()->count(2)->create();

        DB::enableQueryLog();

        $searchResultForEmpty = Medicine::query()->search('')->get();
        $searchResultForNull = Medicine::query()->search()->get();

        $queryLog = DB::getQueryLog();

        $this->assertCount(2, $queryLog, 'queries must be only 2');
        $this->assertCount(2, $searchResultForEmpty);
        $this->assertCount(2, $searchResultForNull);
    }

    #[Test]
    public function it_search_medicine_with_spaces(): void
    {
        $medicines = MedicineFactory::new()->count(2)->state(new Sequence(
            ['name' => 'first medicine'],
            ['name' => 'second medicine'],
        ))->create();

        $searchResult = Medicine::query()->search('fir medic')->get();

        $this->assertTrue($searchResult->contains($medicines[0]));
        $this->assertTrue($searchResult->doesntContain($medicines[1]));
    }
}
