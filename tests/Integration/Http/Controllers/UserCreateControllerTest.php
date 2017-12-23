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
        $response = $this->postJson('/api/user', [
            'name' => 'zzzxxxccc',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
        $response->assertJson([
            'name' => 'zzzxxxccc',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
        $response->assertStatus(200);
    }
}
