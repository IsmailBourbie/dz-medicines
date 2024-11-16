<?php

namespace Database\Seeders;

use Database\Factories\MedicineFactory;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        MedicineFactory::new()->count(25)->withDci()->create();
    }
}
