<?php

namespace Tests\Medicines\Unit;

use Domains\Medicines\ValueObjects\CodeValue;
use PHPUnit\Framework\Attributes\DataProvider;
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

    #[Test]
    #[DataProvider('invalidCode')]
    public function code_value_must_be_valid($inputVal): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new CodeValue($inputVal);
    }

    public static function invalidCode(): array
    {
        return [
            'the code cannot be empty' => [''],
            'the code must start with 2 valid digits' => ['99 A 001'],
            'the code must have a letter between digits' => ['01 _ 001'],
            'the code must end with 3 valid digits' => ['01 A 1000'],
            'the code must have space before and after the letter' => ['01A003'],
        ];
    }
}
