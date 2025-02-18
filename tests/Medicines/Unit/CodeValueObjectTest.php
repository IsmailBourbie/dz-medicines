<?php

namespace Tests\Medicines\Unit;

use Domains\Medicines\ValueObjects\CodeValue;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class CodeValueObjectTest extends TestCase
{

    #[Test]
    public function it_must_be_stringable(): void
    {
        $codeValue = new CodeValue('03 A 003');

        $this->assertIsString((string) $codeValue);
        $this->assertEquals('03 A 003', (string) $codeValue);

    }

    #[Test]
    public function it_get_speciality_id(): void
    {
        $codeValue = new CodeValue('03 A 003');

        $this->assertIsInt($codeValue->classId());
        $this->assertEquals(3, $codeValue->classId());

    }
}
