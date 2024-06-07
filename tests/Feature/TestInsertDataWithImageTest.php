<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TestInsertDataWithImageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        Storage::fake('local');
 
        $response = $this->post('/api/store-image', [
            'name'=>'test user',
            'email'=>'test@example.com',
            'password'=>'test',
            'image'=>UploadedFile::fake()->image('photo.jpg')
        ]);
        Log::info($response->getContent());
        $response->assertStatus(200);
        $filename = $response->json('res.image_name');
        Storage::disk('public')->assertExists('users/' . $filename);
        
    }
}
