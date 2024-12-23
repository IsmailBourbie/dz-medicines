<?php

namespace Tests\Medicines\Models;

use Domains\Medicines\Models\Medicine;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MedicineTest extends TestCase
{

    #[Test]
    public function it_has_path_based_on_slug(): void
    {
        $medicine = new Medicine(['slug' => 'hello-world']);

        $this->assertEquals('medicines/hello-world', $medicine->path());
    }

}
