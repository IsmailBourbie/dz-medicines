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
            'speciality_id' => SpecialityFactory::new()->createOne(),
            'value' => $this->faker->regexify('\d{2}[A-Z]\d{3}'),
        ];
    }
}
