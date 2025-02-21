<?php

namespace Domains\Medicines\DTOs;

class MedicineData
{

    public function __construct(
        public string $name,
        public string $dci,
        public string $form,
        public string $dosage,
        public string $packaging,
        public bool $is_generic,
        public bool $is_local,
        public int $laboratory_id,
        public int $code_id,
    ) {
    }

    public static function fromArray(array $data): self
    {
        $data["NOM DE MARQUE"];
        $data["DENOMINATION COMMUNE INTERNATIONALE"];
        $data["FORME"];
        $data["DOSAGE"];
            $data["CONDITIONNEMENT"] ?? $data["COND"];
        $data["TYPE"] === "GE";
        $data["STATUT"] === "F";

        return new self(
            name: $data["NOM DE MARQUE"],
            dci: $data["DENOMINATION COMMUNE INTERNATIONALE"],
            form: $data["FORME"],
            dosage: $data["DOSAGE"],
            packaging: $data["CONDITIONNEMENT"] ?? $data["COND"],
            is_generic: $data["TYPE"] === "GE",
            is_local: $data["STATUT"] === "F",
            laboratory_id: $data['CODE_ID'],
            code_id: $data['LABORATORY_ID']
        );
    }
}
