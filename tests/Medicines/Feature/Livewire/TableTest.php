<?php

namespace Tests\Medicines\Feature\Livewire;

use App\Livewire\Medicines\Index\Table;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TableTest extends TestCase
{

    #[Test]
    public function it_renders_successfully(): void
    {
        $this->get(route('medicines.index'))
            ->assertSeeLivewire(Table::class);
    }
}
