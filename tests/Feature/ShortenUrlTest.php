<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Url;

class ShortenUrlTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_shorten_simple_url(): void
    {
        $response = $this->getJson('/encode?url=https://test.com/');

        $response->assertStatus(200)
        ->assertJsonStructure([
            'url',
            'shorturl'
        ]);
    }

    public function test_it_can_shorten_complex_url(): void
    {
        $response = $this->getJson('/encode?url=https://test.com/test-encode/test-one/testTwo/?test_param=testing&second_param=testing2');

        $response->assertStatus(200)
        ->assertJsonStructure([
            'url',
            'shorturl'
        ]);
    }

    public function test_it_can_decode_shortened_url(): void
    {
        $url = Url::create([
            'original_url' => 'https://test.com/test-decode',
            'short_code' => 'test123'
        ]);

        $response = $this->getJson('/decode/test123');

        $response->assertStatus(200)
        ->assertJsonStructure([
            'url',
            'shorturl'
        ]);
    }

    public function test_it_returns_400_if_url_is_not_provided(): void
    {
        $response = $this->get('/encode?=');
        $response->assertStatus(400);
    }

    public function test_it_returns_404_if_shortcode_does_not_exist(): void
    {
        $response = $this->get('/decode/invalid');
        $response->assertStatus(404);
    }
}
