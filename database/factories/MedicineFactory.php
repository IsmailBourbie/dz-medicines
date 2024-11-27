<?php

namespace Database\Factories;

use Domains\Medicines\Models\Dci;
use Domains\Medicines\Models\Laboratory;
use Domains\Medicines\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicineFactory extends Factory
{
    protected $model = Medicine::class;

    public function definition(): array
    {
        $name = $this->faker->words(rand(2, 3), true);
        $form = $this->faker->randomElement(['COMP', 'SUPP', 'INJ']);
        $packaging = 'BTE '.$this->faker->randomElement([10, 20, 30, 90]);

        return [
            'full_name' => $name.' '.$form.' '.$packaging,
            'name' => $name,
            'slug' => $this->faker->unique()->slug(),
            'form' => $form,
            'packaging' => $packaging,
            'laboratory_id' => LaboratoryFactory::new()->createOne(),
        ];
    }

    public function withDci(?Dci $dci = null, ?string $dosage = null): static
    {
        return $this->afterCreating(function (Medicine $medicine) use ($dci, $dosage) {
            $medicine->dci()->attach($dci ?? DciFactory::new()->createOne(), [
                'dosage' => $dosage ?? $this->faker->numberBetween(10, 100).'mg',
            ]);
        });
    }

    public function withLab(Laboratory $lab): static
    {
        return $this->state(function (array $attributes) use ($lab) {
            return ['laboratory_id' => $lab];
        });
    }

}
