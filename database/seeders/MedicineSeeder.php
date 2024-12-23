<?php

namespace Database\Seeders;

use Database\Factories\CodeFactory;
use Database\Factories\LaboratoryFactory;
use Database\Factories\MedicineFactory;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {

        // Some real data
        $paracetamol = CodeFactory::new()->createOne(['name' => 'paracetamol']);
        $codeine = CodeFactory::new()->createOne(['name' => 'codeine']);

        $sanofi = LaboratoryFactory::new()->createOne(['name' => 'Sanofi', 'country' => 'France']);
        $merenal = LaboratoryFactory::new()->createOne(['name' => 'Merenal', 'country' => 'Algeria']);

        $doliprane = MedicineFactory::new()->withDci($paracetamol, '500mg')->for($sanofi)->createOne([
            'name' => 'doliprane',
            'slug' => 'doliprane-500mg-comp',
            'form' => 'COMP',
            'packaging' => 'bte 8',
        ]);
        $dolyc = MedicineFactory::new()->withDci($paracetamol, '500mg')->for($merenal)->createOne([
            'name' => 'dolyc',
            'slug' => 'dolyc-500mg-comp',
            'form' => 'COMP',
            'packaging' => 'bte 10',
        ]);
        $codolipran = MedicineFactory::new()->withDci($paracetamol, '400mg')
            ->for($sanofi)->withDci($codeine, '20mg')
            ->createOne([
                'name' => 'codolipran',
                'slug' => 'codoliprane-500mg-comp',
                'form' => 'COMP',
                'packaging' => 'bte 10',
            ]);

        // Fake Data
        MedicineFactory::new()->count(25)->withDci()->create();
    }
}
