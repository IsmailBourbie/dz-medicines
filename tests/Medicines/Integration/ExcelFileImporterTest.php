<?php

namespace Tests\Medicines\Integration;

use Domains\Medicines\DTOs\MedicineData;
use Domains\Medicines\Models\Medicine;
use Domains\Medicines\Services\Contracts\FileImporterInterface;
use Domains\Medicines\Services\Contracts\FileReaderInterface;
use Domains\Medicines\Services\MedicineImporter;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\LazyCollection;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Test;
use Psr\Log\LoggerInterface;
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

        $importer = $this->app->make(FileImporterInterface::class);
        $importer->import($file);

    }

    #[Test]
    public function it_throw_an_exception_for_invalid_data(): void
    {
        $row = [
            "CODE" => "hello",
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
            LoggerInterface::class,
            $this->mock(LoggerInterface::class, function (MockInterface $mock) use ($row) {
                $mock->shouldReceive('error')
                    ->withArgs(function (string $message, array $context) use ($row) {
                        $expectedMessage = "Row 0 import failed: ";

                        return
                            str_starts_with($message, $expectedMessage)
                            && strlen($message) > strlen($expectedMessage)
                            && isset($context['row']) && $context['row'] === $row
                            && isset($context['exception']) && $context['exception'] instanceof \Throwable;
                    })
                    ->once();
            })
        );

        $importer = $this->app->make(FileImporterInterface::class);
        $importer->import($file);

    }
}
