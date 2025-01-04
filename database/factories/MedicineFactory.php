<?php

namespace Database\Factories;

use Domains\Medicines\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicineFactory extends Factory
{
    protected $model = Medicine::class;

    public function definition(): array
    {
        $name = $this->faker->words(rand(1, 2), true);
        $dosage = $this->faker->randomElement(['10mg', '2.5mg', '1g', "75µg", '3%']);
        $form = $this->faker->randomElement(['COMP', 'SUPP', 'INJ']);
        $packaging = 'BTE '.$this->faker->randomElement([10, 20, 30, 90]);

        return [
            'label' => $name.' '.$dosage.' '.$form.' '.$packaging,
            'name' => $name,
            'dci' => $this->faker->words(rand(2, 3), true),
            'slug' => $this->faker->unique()->slug(),
            'form' => $form,
            'dosage' => $dosage,
            'packaging' => $packaging,
            'code_id' => CodeFactory::new(),
            'laboratory_id' => LaboratoryFactory::new(),
        ];
    }

}
