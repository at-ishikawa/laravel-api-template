<?php

namespace Tests\Integration\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserCreateControllerTest extends TestCase
{
    use DatabaseMigrations;

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
        $response->assertJsonStructure([
            'token',
        ]);
        $response->assertStatus(200);
    }
}
