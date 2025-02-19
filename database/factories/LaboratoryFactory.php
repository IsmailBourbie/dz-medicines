<?php

namespace Database\Factories;

use Domains\Medicines\Models\Laboratory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LaboratoryFactory extends Factory
{
    protected $model = Laboratory::class;

    public function definition(): array
    {
        $name = $this->faker->company;
        $country = $this->faker->country;

        return [
            'slug' => Str::slug($name.' '.$country),
            'name' => $name,
            'country' => $country,
        ];
    }
}
