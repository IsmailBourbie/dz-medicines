<?php

namespace Tests\Medicines\Feature\Livewire;

use App\Livewire\Medicines\Index\Table;
use Database\Factories\MedicineFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicineSearchControllerTest extends TestCase
{

    #[Test]
    public function it_search_medicine_with_spaces(): void
    {
        $medicines = MedicineFactory::new()->count(2)->state(new Sequence(
            ['name' => 'first medicine'],
            ['name' => 'second medicine'],
        ))->create();

        $response = Livewire::test(Table::class)
            ->set('query', 'fir medic');

        $response->assertSeeText($medicines[0]->name)
            ->assertDontSeeText($medicines[1]->name);

    }
}
