<?php

namespace Tests\Medicines\Unit;

use Domains\Medicines\DTOs\MedicineData;
use Domains\Medicines\ValueObjects\CodeValue;
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
            "DENOMINATION COMMUNE INTERNATIONALE" => "DCI Name",
            "NOM DE MARQUE" => "DOLIPRANE",
            "FORME" => "SOL.INJ.",
            "DOSAGE" => "5MG/ML",
            "COND" => "B/05 AMP. DE 1ML",
            "LABORATOIRES DETENTEUR DE LA DECISION D'ENREGISTREMENT" => "SCHERING PLOUGH",
            "PAYS DU LABORATOIRE DETENTEUR DE LA DECISION D'ENREGISTREMENT" => "FRANCE",
            "TYPE" => "RE",
            "STATUT" => "I",
        ];


        $dto = MedicineData::fromArray($array);

        $this->assertInstanceOf(MedicineData::class, $dto);
        $this->assertInstanceOf(CodeValue::class, $dto->code);
        $this->assertEquals('DCI Name', $dto->dci);
        $this->assertEquals('DOLIPRANE', $dto->name);
        $this->assertEquals("SOL.INJ.", $dto->form);
        $this->assertEquals("5MG/ML", $dto->dosage);
        $this->assertEquals("B/05 AMP. DE 1ML", $dto->packaging);
        $this->assertEquals("SCHERING PLOUGH", $dto->laboratory_name);
        $this->assertEquals("FRANCE", $dto->country);
        $this->assertFalse($dto->is_generic);
        $this->assertFalse($dto->is_local);
    }

    #[Test]
    public function it_choose_one_key_for_packaging(): void
    {
        $array = [
            "random" => 'hello',
            "CODE" => "01 A 004",
            "DENOMINATION COMMUNE INTERNATIONALE" => "DEXCHLORPHENIRAMINE MALEATE",
            "NOM DE MARQUE" => "POLARAMINE",
            "FORME" => "SOL.INJ.",
            "DOSAGE" => "5MG/ML",
            "CONDITIONNEMENT" => "B/05 AMP. DE 1ML",
            "LABORATOIRES DETENTEUR DE LA DECISION D'ENREGISTREMENT" => "SCHERING PLOUGH",
            "PAYS DU LABORATOIRE DETENTEUR DE LA DECISION D'ENREGISTREMENT" => "FRANCE",
            "TYPE" => "RE",
            "STATUT" => "I",
        ];

        $dto = MedicineData::fromArray($array);

        $this->assertEquals("B/05 AMP. DE 1ML", $dto->packaging);

    }
}
