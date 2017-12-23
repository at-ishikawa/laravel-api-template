<?php

namespace App\Domains;

use Tests\TestCase;

class ArrayableTest extends TestCase
{
    /**
     * @test
     */
    public function toArray(): void
    {
        $arrayable = new ArrayableMock();
        $arrayable->name = 'name';
        $actual = $arrayable->toArray();
        $this->assertCount(1, $actual);
        $this->assertArrayHasKey('name', $actual);
        $this->assertSame('name', $actual['name']);
    }
}

class ArrayableMock
{
    use Arrayable;

    public $name;
}
