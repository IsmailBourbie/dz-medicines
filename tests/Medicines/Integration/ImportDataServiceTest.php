<?php

namespace Tests\Medicines\Integration;

use Domains\Medicines\Models\Laboratory;
use Domains\Medicines\Models\Medicine;
use Domains\Medicines\Services\ImportDataService;
use Illuminate\Support\LazyCollection;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ImportDataServiceTest extends TestCase
{

    #[Test]
    public function it_import_all_needed_data_to_database(): void
    {
        $service = new ImportDataService(new LazyCollection($this->data()));

        $service->importAllData();

        $this->assertDatabaseCount(Laboratory::class, 3);
        $this->assertDatabaseCount(Medicine::class, count($this->data()));

    }

    private function data(): array
    {
        return [
            [
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
            ],
            [
                "CODE" => "01 A 003",
                "DENOMINATION COMMUNE INTERNATIONALE" => "CETIRIZINE DICHLORHYDRATE",
                "NOM DE MARQUE" => "CETIRIPEX",
                "FORME" => "COMPRIME PELLICULE SECABLE",
                "DOSAGE" => "10MG",
                "CONDITIONNEMENT" => "B/15",
                "LABORATOIRES DETENTEUR DE LA DECISION D'ENREGISTREMENT" => "PHARMALLIANCE",
                "PAYS DU LABORATOIRE DETENTEUR DE LA DECISION D'ENREGISTREMENT" => "ALGERIE",
                "TYPE" => "GE",
                "STATUT" => "F",
            ],
            [
                "CODE" => "01 A 003",
                "DENOMINATION COMMUNE INTERNATIONALE" => "CETIRIZINE DICHLORHYDRATE",
                "NOM DE MARQUE" => "ZYTREX",
                "FORME" => "COMPRIME PELLICULE",
                "DOSAGE" => "10MG",
                "CONDITIONNEMENT" => "B/10",
                "LABORATOIRES DETENTEUR DE LA DECISION D'ENREGISTREMENT" => "LAM",
                "PAYS DU LABORATOIRE DETENTEUR DE LA DECISION D'ENREGISTREMENT" => "ALGERIE",
                "TYPE" => "GE",
                "STATUT" => "F",
            ],
        ];
    }
}
