<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    public function testCreateCookie()
    {
        $this->get('/cookie/set')
            ->assertSeeText('Hello Cookie')
            ->assertCookie('User-Id', 'iqbal')
            ->assertCookie('Is-Member', 'true');
    }
    public function testGetCookie()
    {
        $this->withCookie('User-Id', 'iqbal')
            ->withCookie('Is-Member', 'true')
            ->get('/cookie/get')
            ->assertJson([
                "userId" => "iqbal",
                "isMember" => "true"
            ]);
    }
}
