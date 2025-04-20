<?php

namespace Tests\Medicines\Integration;

use Database\Factories\CodeFactory;
use Domains\Medicines\ValueObjects\CodeValue;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CodeTest extends TestCase
{

    #[Test]
    public function it_cast_code_value_as_value_object(): void
    {
        $code = CodeFactory::new()->createOneQuietly();


        $this->assertInstanceOf(CodeValue::class, $code->fresh()->value);
    }
}
