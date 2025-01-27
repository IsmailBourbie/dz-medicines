<?php

namespace Tests\Auth\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    #[Test]
    public function it_render_login_page(): void
    {
        $this->get(route('login'))->assertSuccessful();
    }
}
