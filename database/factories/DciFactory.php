<?php

namespace Database\Factories;

use Domains\Medicines\Models\Dci;
use Illuminate\Database\Eloquent\Factories\Factory;

class DciFactory extends Factory
{
    protected $model = Dci::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
        ];
    }
}
