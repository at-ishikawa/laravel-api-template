<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\RequestValidator;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class RequestValidatorTest extends TestCase
{
    /** @var RequestValidator */
    private $sut;

    /**
     * @before
     */
    public function before()
    {
        $this->sut = new RequestValidator();
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function testValidate(): void
    {
        $input = [
            'name' => 'jonathan1234',
            'email' => 'test@example.com',
            'password' => 'password',
        ];
        Config::shouldReceive('offsetGet');
        Config::shouldReceive('get')
            ->once()
            ->with('requests.rules.user.update')
            ->andReturn([
                'name' => [],
                'email' => [],
                'password' => [],
            ]);
        $actual = $this->sut->validateByInput($input, 'user.update');
        $this->assertNotEmpty($actual);
    }

    /**
     * @param array $input
     * @expectedException  \Illuminate\Validation\ValidationException
     * @dataProvider provideValidateDataSet
     */
    public function testValidateForException($input): void
    {
        Config::shouldReceive('offsetGet');

        Config::shouldReceive('get')
            ->once()
            ->with('requests.rules.user.update')
            ->andReturn([
                'name' => [
                    'min:8',
                ],
                'email' => [
                    'email',
                ],
                'password' => [],
            ]);
        $this->sut->validateByInput($input, 'user.update');
    }

    public function provideValidateDataSet(): array
    {
        return [
            'invalidate one field' => [
                'input' => [
                    'name' => 'name',
                    'email' => 'test@example.com',
                ],
            ],
            'invalidate all fields' => [
                'input' => [
                    'name' => 'name',
                    'email' => 'test',
                ],
            ],
        ];
    }
}
