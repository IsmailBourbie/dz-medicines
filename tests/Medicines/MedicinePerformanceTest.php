<?php

namespace Tests\Medicines;

use Database\Factories\CodeFactory;
use Database\Factories\MedicineClassFactory;
use Database\Factories\MedicineFactory;
use Domains\Medicines\Models\Medicine;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicinePerformanceTest extends TestCase
{
    protected Medicine $medicine;

    protected function setUp(): void
    {
        parent::setUp();

        $class = MedicineClassFactory::new()->createOne();
        $code = CodeFactory::new()->for($class)->createOne();
        $medicines = MedicineFactory::new()->count(2)->for($code)->create();
        $this->medicine = $medicines->random();
        // Enable query logging
        DB::enableQueryLog();
    }

    #[Test]
    public function test_database_query_performance_for_index_page()
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
    public function test_database_query_performance_for_show_page()
    {
        /*
         * 1- get the medicine
         * 2- get the laboratory
         * 3- get the class
         * 4- get related medicines by laboratory
         * 5- get related medicines by class
         * 6- get related generics medicines
         * */
        $expectedQueries = 6;
        $this->get($this->medicine->path());
        $queries = count(DB::getQueryLog());

        $this->assertEquals(
            $expectedQueries,
            $queries,
            "Too many queries executed: $queries"
        );
    }
}
