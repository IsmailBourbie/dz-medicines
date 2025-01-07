<?php

namespace Tests\Medicines\Feature\Livewire;

use App\Livewire\Medicines\Index\Table;
use Database\Factories\CodeFactory;
use Database\Factories\LaboratoryFactory;
use Database\Factories\MedicineClassFactory;
use Database\Factories\MedicineFactory;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicineTableTest extends TestCase
{

    #[Test]
    public function it_renders_successfully(): void
    {
        $this->get(route('medicines.index'))
            ->assertSeeLivewire(Table::class);
    }

    #[Test]
    public function it_get_medicines_form_laboratory_as_source(): void
    {
        $laboratory = LaboratoryFactory::new()->createOne();
        $medicines = MedicineFactory::new()->count(2)->for($laboratory)->create();
        $otherMedicine = MedicineFactory::new()->createOne(['name' => 'other-medicine']);

        $response = Livewire::test(Table::class)->set('source', $laboratory);

        $response->assertSeeText([
            $medicines[0]->name, $medicines[1]->name,
        ])->assertDontSeeText($otherMedicine->name);

    }

    #[Test]
    public function it_get_medicines_form_class_as_source(): void
    {
        $class = MedicineClassFactory::new()->createOne();
        $code = CodeFactory::new()->for($class)->createOne();
        $medicines = MedicineFactory::new()->count(2)->for($code)->create();
        $otherMedicine = MedicineFactory::new()->createOne(['name' => 'other-medicine']);

        $response = Livewire::test(Table::class)->set('source', $class);

        $response->assertSeeText([
            $medicines[0]->name, $medicines[1]->name,
        ])->assertDontSeeText($otherMedicine->name);

    }

    #[Test]
    public function it_get_all_medicines_for_unspecified_source(): void
    {
        $medicines = MedicineFactory::new()->count(2)->create();

        $response = Livewire::test(Table::class);

        $response->assertSeeText([
            $medicines[0]->name, $medicines[1]->name,
        ]);
    }
}
