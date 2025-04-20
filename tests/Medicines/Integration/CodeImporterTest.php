<?php

namespace Tests\Medicines\Integration;

use Database\Factories\CodeFactory;
use Database\Seeders\MedicineClassSeeder;
use Domains\Medicines\Services\CodeImporter;
use Domains\Medicines\ValueObjects\CodeValue;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CodeImporterTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(MedicineClassSeeder::class);
    }

    #[Test]
    public function it_import_code(): void
    {
        (new CodeImporter())->import(new CodeValue('01 A 003'));

        $this->assertDatabaseHas("codes", [
            "value" => "01 A 003",
            'class_id' => '01',
        ]);

    }

    #[Test]
    public function it_return_code_if_exits_without_recreation(): void
    {
        $code = CodeFactory::new()->createOneQuietly(['value' => '01 A 003']);
        $importedCode = (new CodeImporter())->import(new CodeValue($code->value));

        $this->assertTrue($code->is($importedCode));
        $this->assertDatabaseCount("codes", 1);

    }

}
