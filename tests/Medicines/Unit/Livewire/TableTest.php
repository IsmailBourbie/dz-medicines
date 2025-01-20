<?php

namespace Tests\Medicines\Unit\Livewire;

use App\Livewire\Medicines\Index\Table;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class TableTest extends TestCase
{
    #[Test]
    public function it_get_is_generic_as_nullable_boolean(): void
    {
        $table = new Table();

        $reflection = new ReflectionClass($table);
        $method = $reflection->getMethod('isGeneric');

        $this->assertNull($method->invoke($table));

        $table->type = 'generics';
        $this->assertTrue($method->invoke($table));

        $table->type = 'innovators';
        $this->assertFalse($method->invoke($table));
    }
}
