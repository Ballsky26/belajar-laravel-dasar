<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/pzn')
            ->assertStatus(200)
            ->assertSeeText('Hello Ballsky');
    }
    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/pzn');
    }
    public function testFallback()
    {
        $this->get('/tidakada')
            ->assertSeeText('404 by Ballsky');
        $this->get('/tidakadalagi')
            ->assertSeeText('404 by Ballsky');
        $this->get('/ups')
            ->assertSeeText('404 by Ballsky');
    }
}
