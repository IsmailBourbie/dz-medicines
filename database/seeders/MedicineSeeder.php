<?php

namespace Database\Seeders;

use Database\Factories\LaboratoryFactory;
use Database\Factories\MedicineFactory;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        $sanofi = LaboratoryFactory::new()->createOne(['name' => 'Sanofi', 'country' => 'France']);
        $merenal = LaboratoryFactory::new()->createOne(['name' => 'Merenal', 'country' => 'Algeria']);

        $doliprane = MedicineFactory::new()->for($sanofi)->createOne([
            'name' => 'doliprane',
            'dci' => 'paracetamol',
            'dosage' => '500mg',
            'slug' => 'doliprane-500mg-comp',
            'form' => 'COMP',
            'packaging' => 'bte 8',
        ]);
        $dolyc = MedicineFactory::new()->for($merenal)->createOne([
            'name' => 'dolyc',
            'dci' => 'paracetamol',
            'dosage' => '500mg',
            'slug' => 'dolyc-500mg-comp',
            'form' => 'COMP',
            'packaging' => 'bte 10',
        ]);
        $codolipran = MedicineFactory::new()->for($sanofi)->createOne([
            'name' => 'co-doliprane',
            'dci' => 'paracetamol/codeine',
            'dosage' => '400mg/20mg',
            'slug' => 'codoliprane-500mg-comp',
            'form' => 'COMP',
            'packaging' => 'bte 20',
        ]);

        // Fake Data
        MedicineFactory::new()->count(25)->create();
    }
}
