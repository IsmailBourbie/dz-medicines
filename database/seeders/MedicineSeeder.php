<?php

namespace Database\Seeders;

use Database\Factories\DciFactory;
use Database\Factories\MedicineFactory;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {

        // Some real data
        $paracetamol = DciFactory::new()->createOne(['name' => 'paracetamol']);
        $codeine = DciFactory::new()->createOne(['name' => 'codeine']);

        $doliprane = MedicineFactory::new()->withDci($paracetamol, '500mg')->createOne([
            'name' => 'doliprane',
            'slug' => 'doliprane-500mg-comp',
            'form' => 'COMP',
            'packaging' => 'bte 8',
        ]);
        $dolyc = MedicineFactory::new()->withDci($paracetamol, '500mg')->createOne([
            'name' => 'dolyc',
            'slug' => 'dolyc-500mg-comp',
            'form' => 'COMP',
            'packaging' => 'bte 10',
        ]);
        $codolipran = MedicineFactory::new()->withDci($paracetamol, '400mg')->withDci($codeine, '20mg')->createOne([
            'name' => 'codolipran',
            'slug' => 'codoliprane-500mg-comp',
            'form' => 'COMP',
            'packaging' => 'bte 10',
        ]);
        
        // Fake Data
        MedicineFactory::new()->count(25)->withDci()->create();
    }
}
