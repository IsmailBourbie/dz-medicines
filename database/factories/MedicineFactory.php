<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\Medicines\Models\Medicine;

class MedicineFactory extends Factory
{
    protected $model = Medicine::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(rand(1, 2), true),
        ];
    }
}
