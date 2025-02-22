<?php

namespace Tests\Medicines\Integration;

use Domains\Medicines\DTOs\MedicineData;
use Domains\Medicines\Models\Medicine;
use Domains\Medicines\Services\ImportDataService;
use Domains\Medicines\Services\MedicineImporter;
use Illuminate\Support\LazyCollection;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ImportDataServiceTest extends TestCase
{

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

        $this->instance(
            MedicineImporter::class,
            $this->mock(MedicineImporter::class, function (MockInterface $mock) use ($data) {
                $mock->shouldReceive('import')
                    ->withArgs(function ($data) {
                        return $data instanceof MedicineData;
                    })
                    ->times(count($data))
                    ->andReturnUsing(function () {
                        return new Medicine();
                    });
            })
        );

        $service = $this->app->make(ImportDataService::class);

        $service->importAllData(new LazyCollection($data));

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
        ];
        $service = $this->app->make(ImportDataService::class);

        $service->importAllData(new LazyCollection($data));

        $this->assertDatabaseEmpty(Medicine::class);
    }
}
