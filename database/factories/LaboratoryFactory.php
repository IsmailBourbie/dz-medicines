<?php

namespace Database\Factories;

use Domains\Medicines\Models\Laboratory;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaboratoryFactory extends Factory
{
    protected $model = Laboratory::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'country' => $this->faker->country,
        ];
    }
}
