<?php

namespace Domains\Medicines\DTOs;

use Domains\Medicines\ValueObjects\CodeValue;

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
        public string $laboratory_name,
        public string $country,
        public CodeValue $code,
    ) {
    }

    public static function fromArray(array $data): self
    {

        $packaging = array_key_exists("CONDITIONNEMENT", $data) ? $data["CONDITIONNEMENT"] : $data["COND"];

        return new self(
            name: $data["NOM DE MARQUE"],
            dci: $data["DENOMINATION COMMUNE INTERNATIONALE"],
            form: $data["FORME"],
            dosage: $data["DOSAGE"],
            packaging: $packaging,
            is_generic: $data["TYPE"] === "GE",
            is_local: $data["STATUT"] === "F",
            laboratory_name: $data["LABORATOIRES DETENTEUR DE LA DECISION D'ENREGISTREMENT"],
            country: $data["PAYS DU LABORATOIRE DETENTEUR DE LA DECISION D'ENREGISTREMENT"],
            code: new CodeValue($data['CODE'])
        );
    }
}
