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

        $doliprane = MedicineFactory::new()->createOne(['name' => 'doliprane']);
        $dolyc = MedicineFactory::new()->createOne(['name' => 'dolyc']);
        $codolipran = MedicineFactory::new()->createOne(['name' => 'codolipran']);

        $doliprane->dci()->attach($paracetamol, [
            'slug' => 'doliprane-500mg-comp',
            'form' => 'COMP',
            'dosage' => '500mg',
            'packaging' => 'bte 8',
        ]);
        $dolyc->dci()->attach($paracetamol, [
            'slug' => 'dolyc-500mg-comp',
            'form' => 'COMP',
            'dosage' => '500mg',
            'packaging' => 'bte 10',
        ]);

        $codolipran->dci()->attach($paracetamol, [
            'slug' => 'codoliprane-500mg-comp',
            'form' => 'COMP',
            'dosage' => '500mg',
            'packaging' => 'bte 10',
        ]);
        $codolipran->dci()->attach($codeine, [
            'slug' => 'codoliprane-500mg-comp',
            'form' => 'COMP',
            'dosage' => '30mg',
            'packaging' => 'bte 10',
        ]);


        // Fake Data
        MedicineFactory::new()->count(25)->withDci()->create();
    }
}
