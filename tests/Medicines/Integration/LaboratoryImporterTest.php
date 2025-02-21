<?php

namespace Tests\Medicines\Integration;

use Database\Factories\LaboratoryFactory;
use Domains\Medicines\Services\LaboratoryImporter;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LaboratoryImporterTest extends TestCase
{
    #[Test]
    public function it_import_laboratory(): void
    {
        $name = 'hello world';
        $country = 'algeria';

        (new LaboratoryImporter())->import($name, $country);

        $this->assertDatabaseHas("laboratories", [
            'name' => $name,
            'country' => $country,
        ]);

    }

    #[Test]
    public function it_return_laboratory_if_exits_without_recreation(): void
    {
        $lab = LaboratoryFactory::new()->createOneQuietly();

        $importedLab = (new LaboratoryImporter())->import($lab->name, $lab->country);

        $this->assertTrue($lab->is($importedLab));
        $this->assertDatabaseCount("laboratories", 1);

    }
}
