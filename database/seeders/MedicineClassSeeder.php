<?php

namespace Database\Seeders;

use Domains\Medicines\Models\MedicineClass;
use Illuminate\Database\Seeder;

class MedicineClassSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->allClasses() as $class) {
            MedicineClass::create($class);
        }

    }

    private function allClasses(): array
    {
        return [
            ['id' => '01', 'name' => 'ALLERGOLOGIES'],
            ['id' => '03', 'name' => 'ANTALGIQUES '],
            ['id' => '04', 'name' => 'ANTI-INFLAMMATOIRES'],
            ['id' => '05', 'name' => 'CANCEROLOGIE'],
            ['id' => '06', 'name' => 'CARDIOLOGIE ET ANGIOLOGIE'],
            ['id' => '07', 'name' => 'DERMATOLOGIE'],
            ['id' => '08', 'name' => 'DIAGNOSTIQUE'],
            ['id' => '09', 'name' => 'ENDOCRINOLOGIE'],
            ['id' => '10', 'name' => 'GASTRO-ENTEROLOGIE'],
            ['id' => '11', 'name' => 'GYNECOLOGIE'],
            ['id' => '12', 'name' => 'HEMATOLOGIE HEMOSTASE'],
            ['id' => '13', 'name' => 'INFECTIOLOGIE'],
            ['id' => '14', 'name' => 'METABOLISME ET DIABETE'],
            ['id' => '15', 'name' => 'NEUROLOGIE'],
            ['id' => '16', 'name' => 'PSYCHIATRIE'],
            ['id' => '17', 'name' => 'OPHTALMOLOGIE'],
            ['id' => '18', 'name' => 'OTOLOGIE'],
            ['id' => '19', 'name' => 'PARASITOLOGIE'],
            ['id' => '20', 'name' => 'PNEUMOLOGIE'],
            ['id' => '21', 'name' => 'RHUMATOLOGIE'],
            ['id' => '22', 'name' => 'RHINOLOGIE'],
            ['id' => '23', 'name' => 'STOMATOLOGIE'],
            ['id' => '25', 'name' => 'UROLOGIE ET NEPHROLOGIE'],
        ];
    }
}
