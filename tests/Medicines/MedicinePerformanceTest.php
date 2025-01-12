<?php

namespace Tests\Medicines;

use Database\Factories\CodeFactory;
use Database\Factories\LaboratoryFactory;
use Database\Factories\MedicineClassFactory;
use Database\Factories\MedicineFactory;
use Domains\Medicines\Models\Laboratory;
use Domains\Medicines\Models\Medicine;
use Domains\Medicines\Models\MedicineClass;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicinePerformanceTest extends TestCase
{
    protected Medicine $medicine;
    protected Laboratory $laboratory;
    protected MedicineClass $class;

    protected function setUp(): void
    {
        parent::setUp();
        $this->laboratory = LaboratoryFactory::new()->createOne();
        $this->class = MedicineClassFactory::new()->createOne();
        $code = CodeFactory::new()->for($this->class)->createOne();
        $medicines = MedicineFactory::new()->count(2)->for($this->laboratory)->for($code)->create();
        $this->medicine = $medicines->random();
        // Enable query logging
        DB::enableQueryLog();
    }

    #[Test]
    public function test_database_query_performance_for_medicine_index_page()
    {
        $expectedQueries = 2; // count total of medicines for pagination + get medicines per page;

        $this->get(route('medicines.index'));
        $queries = count(DB::getQueryLog());

        $this->assertEquals(
            $expectedQueries,
            $queries,
            "Too many queries executed: $queries"
        );
    }

    #[Test]
    public function test_database_query_performance_for_medicine_show_page()
    {
        /*
         * 1- get the medicine
         * 2- load the code
         * 3- load the laboratory
         * 4- load the class
         * 5- get related medicines by laboratory
         * 6- get related medicines by class
         * 7- get related generics medicines by code
         * */
        $expectedQueries = 7;
        $this->get($this->medicine->path());
        $queries = count(DB::getQueryLog());

        $this->assertEquals(
            $expectedQueries,
            $queries,
            "Too many queries executed: $queries"
        );
    }

    #[Test]
    public function test_database_query_performance_for_laboratory_show_page()
    {
        /*
         * 1- get the Laboratory
         * 2- get related medicines
         * 3- count related medicines for pagination
         * */
        $expectedQueries = 3;
        $this->get(route('laboratories.show', $this->laboratory));
        $queries = count(DB::getQueryLog());

        $this->assertEquals(
            $expectedQueries,
            $queries,
            "Too many queries executed: $queries"
        );
    }

    #[Test]
    public function test_database_query_performance_for_class_show_page()
    {
        /*
         * 1- get the class
         * 2- get related medicines
         * 3- count related medicines for pagination
         * */
        $expectedQueries = 3;
        $this->get(route('classes.show', $this->class));
        $queries = count(DB::getQueryLog());

        $this->assertEquals(
            $expectedQueries,
            $queries,
            "Too many queries executed: $queries"
        );
    }
}
