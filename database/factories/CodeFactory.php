<?php

namespace Database\Factories;

use Domains\Medicines\Models\Code;
use Illuminate\Database\Eloquent\Factories\Factory;

class CodeFactory extends Factory
{
    protected $model = Code::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->word,
        ];
    }
}
