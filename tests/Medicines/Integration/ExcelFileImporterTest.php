<?php

namespace Tests\Medicines\Integration;

use Domains\Medicines\DTOs\MedicineData;
use Domains\Medicines\Models\Medicine;
use Domains\Medicines\Services\Contracts\FileReaderInterface;
use Domains\Medicines\Services\ExcelFileImporter;
use Domains\Medicines\Services\MedicineImporter;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\LazyCollection;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ExcelFileImporterTest extends TestCase
{
    #[Test]
    public function it_import_all_needed_data_to_database(): void
    {
        $row = [
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

        $file = UploadedFile::fake()->create('medicines.xlsx');

        $this->instance(
            FileReaderInterface::class,
            $this->mock(FileReaderInterface::class, function (MockInterface $mock) use ($row) {
                $mock->shouldReceive('read')
                    ->withArgs(function ($file) {
                        return $file instanceof UploadedFile;
                    })
                    ->once()
                    ->andReturnUsing(function () use ($row) {
                        return new LazyCollection([$row]);
                    });
            })
        );
        $this->instance(
            MedicineImporter::class,
            $this->mock(MedicineImporter::class, function (MockInterface $mock) {
                $mock->shouldReceive('import')
                    ->withArgs(function ($data) {
                        return $data instanceof MedicineData;
                    })
                    ->atLeast()->once()
                    ->andReturnUsing(function () {
                        return new Medicine();
                    });
            })
        );

        $importer = $this->app->make(ExcelFileImporter::class);
        $importer->import($file);

    }
}
