<?php

namespace Tests\Integration\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserCreateControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @before
     */
    public function before(): void
    {
        $this->createApplication();
    }

    /**
     * @test
     */
    public function handle(): void
    {
        $response = $this->postJson('/users', [
            'name' => 'zzzxxxccc',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'token',
        ]);
     }
}
