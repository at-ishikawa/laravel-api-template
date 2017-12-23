<?php

namespace Tests\Unit\Domains;

use App\DataStore\Database\User;
use App\Domains\ArrayCopyable;
use Tests\TestCase;

class ArrayCopyableTest extends TestCase
{
    /**
     * @test
     */
    public function copyFromArray(): void
    {
        $expected = 'expected name';
        $actual = ArrayCopyableMock::createFromArray([
            'name' => $expected,
        ]);
        /** @noinspection PhpUndefinedFieldInspection */
        $this->assertSame($expected, $actual->name);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function copyFromArrayForInvalidField(): void
    {
        ArrayCopyableMock::createFromArray([
            'invalid field' => 'invalid value',
        ]);
    }

    public function copyFromEloquent(): void
    {
        ArrayCopyableMock::createFromEloquent(new User([
            'name' => 'eloquent name',
        ]));
    }
}

class ArrayCopyableMock
{
    use ArrayCopyable;

    public $name;
}
