<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->post('/api/store-data',[
            'name'=>'test user',
            'email'=>'test@example.com',
            'password'=>'test',
            'image'=>'ss'
        ]);
        $response->assertStatus(200);
    }
}
