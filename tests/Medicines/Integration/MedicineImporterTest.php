<?php

namespace Tests\Medicines\Integration;

use Database\Seeders\MedicineClassSeeder;
use Domains\Medicines\DTOs\MedicineData;
use Domains\Medicines\Services\MedicineImporter;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MedicineImporterTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(MedicineClassSeeder::class);
    }

    #[Test]
    public function it_import_medicine(): void
    {
        $array = [
            "CODE" => "01 A 004",
            "DENOMINATION COMMUNE INTERNATIONALE" => "DEXCHLORPHENIRAMINE MALEATE",
            "NOM DE MARQUE" => "POLARAMINE",
            "FORME" => "SOL.INJ.",
            "DOSAGE" => "5MG/ML",
            "COND" => "B/05 AMP. DE 1ML",
            "LABORATOIRES DETENTEUR DE LA DECISION D'ENREGISTREMENT" => "SCHERING PLOUGH",
            "PAYS DU LABORATOIRE DETENTEUR DE LA DECISION D'ENREGISTREMENT" => "FRANCE",
            "TYPE" => "RE",
            "STATUT" => "I",
        ];

        $data = MedicineData::fromArray($array);

        $medicine = $this->app->make(MedicineImporter::class);

        $medicine->import($data);

        $this->assertDatabaseHas("medicines", [
            'name' => $data->name,
            'dci' => $data->dci,
        ]);

    }
}
