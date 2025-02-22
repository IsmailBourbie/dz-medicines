<?php

namespace Domains\Medicines\Services;

use Domains\Medicines\DTOs\MedicineData;
use Illuminate\Support\LazyCollection;

class ImportDataService
{

    public function __construct(
        private MedicineImporter $medicineImporter,
    ) {
    }

    public function importAllData(LazyCollection $data): void
    {
        $data->each(function (array $row) {
            if (!$row["CODE"]) {
                return;
            }
            $this->medicineImporter->import(MedicineData::fromArray($row));
        });
    }

}
