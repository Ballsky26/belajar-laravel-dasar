<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Iqbal')
            ->assertSeeText('Hello Iqbal');

        $this->post('/input/hello', [
            'name' => 'Iqbal'
        ])->assertSeeText('Hello Iqbal');
    }
    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            "name" => [
                "first" => "Iqbal",
                "last" => "Syaiful"
            ]
        ])
            ->assertSeeText('Hello Iqbal');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            "name" => [
                "first" => "Syaiful",
                "last" => "Iqbal"
            ]
        ])->assertSeeText("name")->assertSeeText("first")
            ->assertSeeText("last")->assertSeeText("Syaiful")
            ->assertSeeText("Iqbal");
    }
    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            "products" => [
                [
                    "name" => "Apple Mac Book Pro",
                    "price" => 30000000
                ],
                [
                    "name" => "Samsung Galaxy S10",
                    "price" => 15000000
                ]
            ]
        ])->assertSeeText("Apple Mac Book Pro")
            ->assertSeeText("Samsung Galaxy S10");
    }
    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Budi',
            'married' => 'true',
            'birth_date' => '1999-01-01'
        ])->assertSeeText('Budi')->assertSeeText("true")->assertSeeText("1999-01-01");
    }
    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "Syaiful",
                "middle" => "Anjay",
                "last" => "Iqbal"
            ]
        ])->assertSeeText("Syaiful")
            ->assertDontSeeText("Anjay")
            ->assertSeeText("Iqbal");
    }
    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            "username" => "syaiful",
            "password" => "rahasia",
            "admin" => "true"
        ])->assertSeeText("syaiful")
            ->assertSeeText("rahasia")
            ->assertDontSeeText("admin");
    }
    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username" => "syaiful",
            "password" => "rahasia",
            "admin" => "true"
        ])->assertSeeText("syaiful")
            ->assertSeeText("rahasia")
            ->assertSeeText("admin")
            ->assertSeeText("false");
    }
}
