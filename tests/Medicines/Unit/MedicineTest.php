<?php

namespace Tests\Medicines\Unit;

use Domains\Medicines\Models\Medicine;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MedicineTest extends TestCase
{
    #[Test]
    public function it_has_path_based_on_slug(): void
    {
        $medicine = new Medicine(['slug' => 'hello-world']);

        $this->assertEquals('/medicines/hello-world', $medicine->path());
    }

    #[Test]
    public function it_gets_the_label_as_uppercases_letter(): void
    {
        $medicine = new Medicine(['label' => 'hello world']);

        $this->assertEquals('HELLO WORLD', $medicine->label);

    }

}
