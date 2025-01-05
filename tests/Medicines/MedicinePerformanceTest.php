<?php

namespace Tests\Medicines;

use Database\Factories\MedicineFactory;
use Domains\Medicines\Models\Medicine;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class MedicinePerformanceTest extends TestCase
{
    protected Medicine $medicine;

    protected function setUp(): void
    {
        parent::setUp();

        $this->medicine = MedicineFactory::new()->createOne();
        // Enable query logging
        DB::enableQueryLog();
    }

    /**
     * Test database query performance
     */
    public function testDatabaseQueryPerformance()
    {
        $startTime = microtime(true);

        $this->get($this->medicine->path());

        $endTime = microtime(true);

        $executionTime = ($endTime - $startTime) * 1000; // Convert to milliseconds

        // Get query log
        $queries = count(DB::getQueryLog());

        // Assert performance metrics
        $this->assertLessThanOrEqual(
            100,
            $executionTime,
            "Query took too long: {$executionTime}ms"
        );

        $this->assertLessThanOrEqual(
            6,
            $queries,
            "Too many queries executed: $queries"
        );
    }
}
