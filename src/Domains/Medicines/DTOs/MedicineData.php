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
        public string $laboratory_name,
        public string $country,
        public string $code,
    ) {
    }

    public static function fromArray(array $data): self
    {
        $data["NOM DE MARQUE"];
        $data["DENOMINATION COMMUNE INTERNATIONALE"];


        return new self(
            name: $data["NOM DE MARQUE"],
            dci: $data["DENOMINATION COMMUNE INTERNATIONALE"],
            form: $data["FORME"],
            dosage: $data["DOSAGE"],
            packaging: $data["CONDITIONNEMENT"] ?? $data["COND"],
            is_generic: $data["TYPE"] === "GE",
            is_local: $data["STATUT"] === "F",
            laboratory_name: $data["LABORATOIRES DETENTEUR DE LA DECISION D'ENREGISTREMENT"],
            country: $data["PAYS DU LABORATOIRE DETENTEUR DE LA DECISION D'ENREGISTREMENT"],
            code: $data['CODE']
        );
    }
}
