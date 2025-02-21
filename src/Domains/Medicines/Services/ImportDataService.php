<?php

namespace Domains\Medicines\Services;

use Domains\Medicines\DTOs\MedicineData;
use Domains\Medicines\Models\Code;
use Domains\Medicines\Models\Laboratory;
use Domains\Medicines\ValueObjects\CodeValue;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;

final readonly class ImportDataService implements ImportDataInterface
{

    public function __construct(private MedicineImporter $medicineImporter)
    {
    }

    public function importAllData(LazyCollection $data): void
    {
        $data->each(function (array $row) {
            if (!$row["CODE"]) {
                return;
            }

            $row['LABORATORY_ID'] = $this->importLaboratoryData(
                $row["LABORATOIRES DETENTEUR DE LA DECISION D'ENREGISTREMENT"],
                $row["PAYS DU LABORATOIRE DETENTEUR DE LA DECISION D'ENREGISTREMENT"]
            );
            $row['CODE_ID'] = $this->importCodeData(new CodeValue($row["CODE"]));

            $medicineDTO = MedicineData::fromArray($row);

            $this->medicineImporter->import($medicineDTO);
//            Medicine::query()->create([
//                'name' => $row["NOM DE MARQUE"],
//                'dci' => $row["DENOMINATION COMMUNE INTERNATIONALE"],
//                'form' => $row["FORME"],
//                'dosage' => $row["DOSAGE"],
//                'packaging' => $row["CONDITIONNEMENT"] ?? $row["COND"],
//                'is_generic' => $row["TYPE"] === "GE",
//                'is_local' => $row["STATUT"] === "F",
//                'laboratory_id' => $this->importLaboratoryData(
//                    $row["LABORATOIRES DETENTEUR DE LA DECISION D'ENREGISTREMENT"],
//                    $row["PAYS DU LABORATOIRE DETENTEUR DE LA DECISION D'ENREGISTREMENT"]
//                ),
//                'code_id' => $this->importCodeData(new CodeValue($row["CODE"])),
//            ]);
        });
    }


    protected function importLaboratoryData(string $name, string $country): int
    {
        return Laboratory::firstOrCreate(['slug' => Str::slug($name.' '.$country)], [
            'name' => $name,
            'country' => $country,
        ])->id;
    }

    protected function importCodeData(CodeValue $value): int
    {
        return Code::firstOrCreate(['value' => $value,], [
            'class_id' => $value->classId(),
        ])->id;
    }
}
