<?php

namespace Domains\Medicines\Services;

use Domains\Medicines\DTOs\MedicineData;
use Domains\Medicines\Services\Contracts\FileReaderInterface;
use Illuminate\Http\UploadedFile;

final readonly class ExcelFileImporter implements Contracts\FileImporterInterface
{

    public function __construct(
        private FileReaderInterface $reader,
        private MedicineImporter $medicineImporter,
    ) {
    }

    public function import(UploadedFile $file): void
    {
        $rows = $this->reader->read($file);

        foreach ($rows as $row) {
            $this->medicineImporter->import(MedicineData::fromArray($row));
        }
    }
}
