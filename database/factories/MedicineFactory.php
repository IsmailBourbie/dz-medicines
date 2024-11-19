<?php

namespace Database\Factories;

use Domains\Medicines\Models\Dci;
use Domains\Medicines\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicineFactory extends Factory
{
    protected $model = Medicine::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(rand(2, 3), true),
        ];
    }

    public function withDci(?Dci $dci = null, array $attributes = []): static
    {
        return $this->afterCreating(function (Medicine $medicine) use ($dci, $attributes) {
            $medicine->dci()->attach($dci ?? DciFactory::new()->createOne(), [
                'slug' => $attributes['slug'] ?? $this->faker->unique()->slug(),
                'dosage' => $attributes['dosage'] ?? $this->faker->numberBetween(10, 100).'mg',
                'form' => $attributes['form'] ?? $this->faker->randomElement(['COMP', 'SUPP', 'INJ']),
                'packaging' => $attributes['packaging'] ?? 'BTE '.$this->faker->randomElement([10, 20, 30, 90]),
            ]);
        });
    }

}
