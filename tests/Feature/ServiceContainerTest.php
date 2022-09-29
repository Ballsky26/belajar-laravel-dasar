<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
    {
        $foo1 = $this->app->make(Foo::class); // new Foo()
        $foo2 = $this->app->make(Foo::class); // new Foo()

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertSame($foo1, $foo2);
    }
    public function testBind()
    {
        // $person = $this->app->make(Person::class); // new Person()
        // self::assertNotNull($person);

        $this->app->bind(Person::class, function ($app) {
            return new Person("Syaiful", "Iqbal");
        });

        $person1 = $this->app->make(Person::class); // clouser() new Person("Syaiful", "Iqbal");
        $person2 = $this->app->make(Person::class); // clouser() new Person("Syaiful", "Iqbal");

        self::assertEquals('Syaiful', $person1->firstName);
        self::assertEquals('Syaiful', $person2->firstName);
        self::assertNotSame($person1, $person2);
    }
    public function testSingleton()
    {
        // $person = $this->app->make(Person::class); // new Person()
        // self::assertNotNull($person);

        $this->app->singleton(Person::class, function ($app) {
            return new Person("Syaiful", "Iqbal");
        });

        $person1 = $this->app->make(Person::class); // clouser() new Person("Syaiful", "Iqbal"); if not exits
        $person2 = $this->app->make(Person::class); // return existing
        $person3 = $this->app->make(Person::class); // clouser() new Person("Syaiful", "Iqbal"); if not exits
        $person4 = $this->app->make(Person::class); // return existing

        self::assertEquals('Syaiful', $person1->firstName);
        self::assertEquals('Syaiful', $person2->firstName);
        self::assertSame($person1, $person2);
    }
    public function testInstance()
    {
        // $person = $this->app->make(Person::class); // new Person()
        // self::assertNotNull($person);
        $person = new Person("Syaiful", "Iqbal");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // $person
        $person2 = $this->app->make(Person::class); // $person
        $person3 = $this->app->make(Person::class); // $person
        $person4 = $this->app->make(Person::class); // $person

        self::assertEquals('Syaiful', $person1->firstName);
        self::assertEquals('Syaiful', $person2->firstName);
        self::assertSame($person1, $person2);
    }
    public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function ($app) {
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);
        self::assertSame($foo, $bar2->foo);
    }

    public function testInterfaceToClass()
    {
        //$this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $this->app->singleton(HelloService::class, function ($app) {
            return new HelloServiceIndonesia();
        });
        $helloService = $this->app->make(HelloService::class);
        self::assertEquals('Halo Iqbal', $helloService->hello('Iqbal'));
    }
}
