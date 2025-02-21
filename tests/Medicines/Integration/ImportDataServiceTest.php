<?php

namespace Tests\Medicines\Integration;

use Database\Seeders\MedicineClassSeeder;
use Domains\Medicines\Models\Code;
use Domains\Medicines\Models\Laboratory;
use Domains\Medicines\Models\Medicine;
use Domains\Medicines\Services\ImportDataService;
use Illuminate\Support\LazyCollection;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ImportDataServiceTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(MedicineClassSeeder::class);
    }

    #[Test]
    public function it_import_all_needed_data_to_database(): void
    {
        $data = [
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
        ];
        $service = $this->app->make(ImportDataService::class);

        $service->importAllData(new LazyCollection($data));

        $this->assertDatabaseCount(Laboratory::class, 2);
        $this->assertDatabaseCount(Medicine::class, 2);
        $this->assertDatabaseCount(Code::class, 2);
    }

    #[Test]
    public function it_skip_empty_data(): void
    {
        $data = [
            [
                "CODE" => "",
                "DENOMINATION COMMUNE INTERNATIONALE" => "",
                "NOM DE MARQUE" => "",
                "FORME" => "",
                "DOSAGE" => "",
                "COND" => "",
                "LABORATOIRES DETENTEUR DE LA DECISION D'ENREGISTREMENT" => "",
                "PAYS DU LABORATOIRE DETENTEUR DE LA DECISION D'ENREGISTREMENT" => "",
                "TYPE" => "",
                "STATUT" => "",
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
        ];
        $service = $this->app->make(ImportDataService::class);

        $service->importAllData(new LazyCollection($data));

        $this->assertDatabaseCount(Medicine::class, 1);
    }

    #[Test]
    public function it_import_data_dealing_with_the_same_code(): void
    {
        $data = [
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
                "CODE" => "01 A 004",
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
        ];
        $service = $this->app->make(ImportDataService::class);

        $service->importAllData(new LazyCollection($data));

        $this->assertDatabaseCount(Medicine::class, 2);
        $this->assertDatabaseCount(Code::class, 1);

    }

    #[Test]
    public function it_import_data_dealing_with_the_same_laboratory(): void
    {
        $data = [
            [
                "CODE" => "01 A 004",
                "DENOMINATION COMMUNE INTERNATIONALE" => "DEXCHLORPHENIRAMINE MALEATE",
                "NOM DE MARQUE" => "POLARAMINE",
                "FORME" => "SOL.INJ.",
                "DOSAGE" => "5MG/ML",
                "COND" => "B/05 AMP. DE 1ML",
                "LABORATOIRES DETENTEUR DE LA DECISION D'ENREGISTREMENT" => "PHARMALLIANCE",
                "PAYS DU LABORATOIRE DETENTEUR DE LA DECISION D'ENREGISTREMENT" => "ALGERIE",
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
        ];
        $service = $this->app->make(ImportDataService::class);

        $service->importAllData(new LazyCollection($data));

        $this->assertDatabaseCount(Medicine::class, 2);
        $this->assertDatabaseCount(Laboratory::class, 1);

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
