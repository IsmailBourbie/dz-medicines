<?php

namespace Tests\Medicines\Feature\Livewire;

use App\Livewire\Medicines\Index\Table;
use Database\Factories\MedicineFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicineSearchTest extends TestCase
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

    #[Test]
    public function it_filter_medicines_by_type(): void
    {
        $medicines = MedicineFactory::new()->count(2)->state(new Sequence(
            ['is_generic' => false],
            ['is_generic' => true],
        ))->create();

        $response = Livewire::test(Table::class)
            ->set('type', 'innovators');

        $response->assertSet('type', 'innovators')
            ->assertSeeText($medicines[0]->name)
            ->assertDontSeeText($medicines[1]->name);

    }

    #[Test]
    public function it_filter_medicines_by_origin(): void
    {
        $medicines = MedicineFactory::new()->count(2)->state(new Sequence(
            ['is_local' => false],
            ['is_local' => true],
        ))->create();

        $response = Livewire::test(Table::class)
            ->set('origin', 'foreign');

        $response
            ->assertSeeText($medicines[0]->name)
            ->assertDontSeeText($medicines[1]->name);

    }

}
