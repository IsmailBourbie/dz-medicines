<?php

namespace Database\Factories;

use Domains\Medicines\Models\MedicineClass;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicineClassFactory extends Factory
{

    protected $model = MedicineClass::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
