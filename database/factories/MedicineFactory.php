<?php

namespace Database\Factories;

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

    public function withDci(): static
    {
        return $this->afterCreating(function (Medicine $medicine) {
            $medicine->dci()->attach(DciFactory::new()->createOne(), [
                'slug' => $this->faker->unique()->slug(),
                'dosage' => $this->faker->numberBetween(10, 100).'mg',
                'form' => $this->faker->randomElement(['COMP', 'SUPP', 'INJ']),
                'packaging' => 'BTE '.$this->faker->randomElement([10, 20, 30, 90]),
            ]);
        });
    }

}
