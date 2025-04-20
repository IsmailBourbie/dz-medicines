<?php

namespace Domains\Medicines\Services;

use Domains\Medicines\DTOs\MedicineData;
use Domains\Medicines\Services\Contracts\FileReaderInterface;
use Illuminate\Http\UploadedFile;
use Psr\Log\LoggerInterface;

final readonly class ExcelFileImporter implements Contracts\FileImporterInterface
{

    public function __construct(
        private FileReaderInterface $reader,
        private MedicineImporter $medicineImporter,
        private LoggerInterface $logger
    ) {
    }

    public function import(UploadedFile $file): void
    {
        $path = $file->storeAs(path: $file->getClientOriginalName(), options: 'temp');

        $fullPath = storage_path("app/temp/{$path}");
        $rows = $this->reader->read($fullPath);

        foreach ($rows as $index => $row) {
            try {
                $this->medicineImporter->import(MedicineData::fromArray($row));
            } catch (\Throwable $th) {
                $this->logger->error("Row $index import failed: ".$th->getMessage(), [
                    'row' => $row,
                    'exception' => $th,
                ]);
            }
        }
    }
}
