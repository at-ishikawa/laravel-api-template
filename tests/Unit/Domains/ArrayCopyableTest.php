<?php

namespace Tests\Unit\Domains;

use App\DataStore\Database\User;
use App\Domains\ArrayCopyable;
use Carbon\Carbon;
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

    /**
     * @test
     */
    public function copyFromEloquent(): void
    {
        $expected_name = 'eloquent name';
        $actual = ArrayCopyableMock::createFromEloquent(new User([
            'name' => $expected_name,
            'created_at' => new Carbon(),
        ]));
        $this->assertSame($expected_name, $actual->name);

        $actual = ArrayCopyableMock::createFromEloquent(new User([
            'name' => $expected_name,
            'password' => 'password',
        ]), [
            'name',
        ]);
        $this->assertNull($actual->password);
        $this->assertSame($expected_name, $actual->name);
    }
}

class ArrayCopyableMock
{
    use ArrayCopyable;

    public $name;

    public $password;
}
