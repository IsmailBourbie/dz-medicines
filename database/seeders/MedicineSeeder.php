<?php

namespace Database\Seeders;

use Database\Factories\CodeFactory;
use Database\Factories\LaboratoryFactory;
use Database\Factories\MedicineFactory;
use Database\Factories\SpecialityFactory;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        $speciality = SpecialityFactory::new()->createOne(['name' => 'antalgique']);

        $paracetamol_code = CodeFactory::new()->for($speciality)->createOne();
        $paracetamol_codeine_code = CodeFactory::new()->for($speciality)->createOne();

        $sanofi = LaboratoryFactory::new()->createOne(['name' => 'Sanofi', 'country' => 'France']);
        $merenal = LaboratoryFactory::new()->createOne(['name' => 'Merenal', 'country' => 'Algeria']);

        $otherLabs = LaboratoryFactory::new()->count(6)->create();

        $doliprane = MedicineFactory::new()
            ->for($sanofi)
            ->for($paracetamol_code)
            ->createOne([
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
        $dolyc = MedicineFactory::new()
            ->for($merenal)
            ->for($paracetamol_code)
            ->createOne([
                'label' => 'dolyc 500mg comp bte 10',
                'name' => 'dolyc',
                'dci' => 'paracetamol',
                'dosage' => '500mg',
                'slug' => 'dolyc-500mg-comp',
                'form' => 'COMP',
                'packaging' => 'bte 10',
            ]);
        $codolyc = MedicineFactory::new()
            ->for($merenal)
            ->for($paracetamol_codeine_code)
            ->createOne([
                'label' => 'co-dolyc 400mg/20mg comp bte 20',
                'name' => 'co-dolyc',
                'dci' => 'paracetamol/codeine',
                'dosage' => '500mg/30mg',
                'slug' => 'co-dolyc-500mg-comp',
                'form' => 'COMP',
                'packaging' => 'bte 20',
                'is_generic' => false,
                'is_local' => false,
            ]);

        // Fake Data
        MedicineFactory::new()->count(25)->sequence(fn() => ['laboratory_id' => $otherLabs->random()])->create();
    }
}
