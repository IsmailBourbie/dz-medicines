<?php

namespace Domains\Medicines\Services;

use Domains\Medicines\Models\Laboratory;
use Domains\Medicines\Models\Medicine;
use Illuminate\Support\LazyCollection;

final readonly class ImportDataService
{
    public function __construct(public LazyCollection $rows)
    {
    }

    public function importAllData(): void
    {
        $this->rows->each(function (array $row) {
            Medicine::query()->create([
                'name' => $row["NOM DE MARQUE"],
                'dci' => $row["DENOMINATION COMMUNE INTERNATIONALE"],
                'form' => $row["FORME"],
                'dosage' => $row["DOSAGE"],
                'packaging' => $row["CONDITIONNEMENT"] ?? $row["COND"],
                'is_generic' => $row["TYPE"] === "GE",
                'is_local' => $row["STATUT"] === "F",
                'laboratory_id' => $this->importLaboratoryData(
                    $row["LABORATOIRES DETENTEUR DE LA DECISION D'ENREGISTREMENT"],
                    $row["PAYS DU LABORATOIRE DETENTEUR DE LA DECISION D'ENREGISTREMENT"]
                ),
                'code_id' => $this->importCodeData($row["CODE"]),
            ]);
        });
    }


    protected function importLaboratoryData(string $name, string $country): int
    {
        return Laboratory::create([
            'name' => $name,
            'country' => $country,
        ])->id;
    }

    protected function importCodeData(CodeValueObject $code): int
    {
        return Code::create([
            'name' => $code,
            'country' => $country,
        ])->id;
    }
}
