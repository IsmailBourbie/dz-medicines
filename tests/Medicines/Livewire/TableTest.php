<?php

namespace Tests\Medicines\Livewire;

use App\Livewire\Medicines\Index\Table;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TableTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_renders_successfully(): void
    {
        $this->get(route('medicines.index'))
            ->assertSeeLivewire(Table::class);
    }
}
