<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Iqbal');
        $this->get('/hello-again')
            ->assertSeeText('Hello Iqbal');
    }
    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('World Iqbal');
    }
    public function tetViewWithoutRoute()
    {
        $this->view('hello', ['name' => 'Iqbal'])
            ->assertSeeText('Hello Iqbal');

        $this->view('hello.world', ['name' => 'Iqbal'])
            ->assertSeeText('World Iqbal');
    }
}
