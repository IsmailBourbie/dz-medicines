<?php

namespace Tests\Laboratory\Controllers;

use Database\Factories\LaboratoryFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LaboratoryControllerTest extends TestCase
{
    #[Test]
    public function it_show_laboratory_page(): void
    {
        $laboratory = LaboratoryFactory::new()->createOne();

        $response = $this->get(route('laboratories.show', $laboratory->id));

        $response->assertSuccessful();
        $response->assertViewIs('laboratories.show');
        $response->assertViewHas('laboratory');
        $response->assertSeeText([$laboratory->name, $laboratory->country]);

    }
}
