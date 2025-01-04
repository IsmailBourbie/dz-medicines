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
            'class_id' => MedicineClassFactory::new(),
            'value' => $this->faker->regexify('\d{2}[A-Z]\d{3}'),
        ];
    }

    public function for($factory, $relationship = 'class'): CodeFactory
    {
        return parent::for($factory, $relationship);
    }
}
