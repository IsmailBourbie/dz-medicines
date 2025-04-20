<?php

namespace Database\Factories;

use Domains\Medicines\Models\Code;
use Domains\Medicines\ValueObjects\CodeValue;
use Illuminate\Database\Eloquent\Factories\Factory;

class CodeFactory extends Factory
{
    protected $model = Code::class;

    public function definition(): array
    {
        return [
            'class_id' => MedicineClassFactory::new(),
            'value' => new CodeValue($this->faker->regexify('(0[1-9]|1[0-9]|2[0-9]|30) [A-Z] [0-9]{3}')),
        ];
    }

    public function for($factory, $relationship = 'class'): CodeFactory
    {
        return parent::for($factory, $relationship);
    }
}
