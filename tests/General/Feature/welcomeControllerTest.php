<?php

namespace Tests\General\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class welcomeControllerTest extends TestCase
{
    #[Test]
    public function it_render_welcome_page_successfully(): void
    {
        $response = $this->get('/');

        $response->assertSuccessful()
            ->assertViewIs('welcome');
    }
}
