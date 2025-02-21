<?php

namespace Tests\Medicines\Unit;

use Domains\Medicines\DTOs\MedicineData;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MedicineDTOTest extends TestCase
{
    #[Test]
    public function it_create_an_instance_from_array_of_data(): void
    {
        $array = [
            "random" => 'hello',
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

        $this->assertInstanceOf(MedicineData::class, MedicineData::fromArray($array));
    }
}
