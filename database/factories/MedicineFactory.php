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
            'dci' => $this->faker->words(rand(2, 3), true),
            'form' => $this->faker->randomElement(['COMP', 'SUPP', 'INJ']),
            'dosage' => $this->faker->randomElement(['10mg', '2.5mg', '1g', "75µg", '3%']),
            'packaging' => 'BTE '.$this->faker->randomElement([10, 20, 30, 90]),
            'code_id' => CodeFactory::new(),
            'laboratory_id' => LaboratoryFactory::new(),
        ];
    }

}
