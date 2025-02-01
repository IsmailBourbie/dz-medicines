<?php

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        UserFactory::new()->createOne([
            'name' => 'Ismail Bourbie',
            'email' => 'test@gmail.com',
        ]);
        
        $this->call([MedicineClassSeeder::class, MedicineSeeder::class]);
    }
}
