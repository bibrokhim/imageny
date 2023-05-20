<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_redirects_guest_to_login_page()
    {
        $response = $this->get('/');

        $response->assertRedirect(route('login'));
    }

    public function test_it_shows_home_page_to_authenticated_user()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
