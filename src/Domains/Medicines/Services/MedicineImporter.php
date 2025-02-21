<?php

namespace Domains\Medicines\Services;

use Domains\Medicines\DTOs\MedicineData;
use Domains\Medicines\Models\Medicine;
use Domains\Medicines\ValueObjects\CodeValue;

class MedicineImporter
{
    public function __construct(
        private LaboratoryImporter $laboratoryImporter,
        private CodeImporter $codeImporter
    ) {
    }

    public function import(MedicineData $data): Medicine
    {
        $laboratory = $this->laboratoryImporter->import(
            $data->laboratory_name,
            $data->country
        );

        $code = $this->codeImporter->import(new CodeValue($data->code));

        return Medicine::query()->create([
            'name' => $data->name,
            'dci' => $data->dci,
            'form' => $data->form,
            'dosage' => $data->dosage,
            'packaging' => $data->packaging,
            'is_generic' => $data->is_generic,
            'is_local' => $data->is_local,
            'laboratory_id' => $laboratory->id,
            'code_id' => $code->id,
        ]);
    }

}
