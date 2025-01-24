<?php

namespace Tests\General\Feature;

use Database\Factories\MedicineClassFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class welcomeControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        MedicineClassFactory::new()->count(12)->create();
    }

    #[Test]
    public function it_render_welcome_page_successfully(): void
    {
        $response = $this->get('/');

        $response->assertSuccessful()
            ->assertViewIs('welcome')
            ->assertViewHas('medicineClasses', function ($classes) {
                return $classes->count() === 12;
            });
    }
}
