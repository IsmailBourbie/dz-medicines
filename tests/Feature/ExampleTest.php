<?php

namespace Tests\Feature;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_create_user(): void
    {
        $user = UserFactory::new()->create(['name' => 'ismail bourbie']);

        $response = $this->get('/');

        $this->assertDatabaseHas($user->getTable(), ['name' => 'ismail bourbie']);
        $response->assertStatus(200);
        $response->assertSee('ismail bourbie');
    }
}
