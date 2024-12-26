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

        $otherLabs = LaboratoryFactory::new()->count(6)->create();

        $doliprane = MedicineFactory::new()->for($sanofi)->createOne([
            'label' => 'doliprane 500mg comp bte 8',
            'name' => 'doliprane',
            'dci' => 'paracetamol',
            'dosage' => '500mg',
            'slug' => 'doliprane-500mg-comp',
            'form' => 'COMP',
            'packaging' => 'bte 8',
            'is_generic' => false,
            'is_local' => false,
        ]);
        $dolyc = MedicineFactory::new()->for($merenal)->createOne([
            'label' => 'dolyc 500mg comp bte 10',
            'name' => 'dolyc',
            'dci' => 'paracetamol',
            'dosage' => '500mg',
            'slug' => 'dolyc-500mg-comp',
            'form' => 'COMP',
            'packaging' => 'bte 10',
        ]);
        $codolipran = MedicineFactory::new()->for($sanofi)->createOne([
            'label' => 'co-doliprane 400mg/20mg comp bte 20',
            'name' => 'co-doliprane',
            'dci' => 'paracetamol/codeine',
            'dosage' => '400mg/20mg',
            'slug' => 'codoliprane-500mg-comp',
            'form' => 'COMP',
            'packaging' => 'bte 20',
            'is_generic' => false,
            'is_local' => false,
        ]);

        // Fake Data
        MedicineFactory::new()->count(25)->sequence(fn() => ['laboratory_id' => $otherLabs->random()])->create();
    }
}
