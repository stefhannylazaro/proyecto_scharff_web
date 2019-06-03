<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->call( 'POST','/ajax/login',
            [
                'user' => 'admin@mail.com',
                'password' => '123456',
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 1,
            ]);
    }
}
