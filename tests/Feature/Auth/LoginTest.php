<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    public function test_it_reauires_a_social_id()
    {
        $this->json('Post', 'api/auth/login')
            ->assertJsonValidationErrors(['social_id']);
    }

    public function test_it_reauires_a_password()
    {
        $this->json('Post', 'api/auth/login')
            ->assertJsonValidationErrors(['password']);
    }

    public function test_it_returns_a_validation_error_if_the_credentials_did_not_match()
    {
        $user = factory(User::class)->create();

        $this->json('Post', 'api/auth/login', [
            'social_id' => $user->social_id,
            'password' => 'passwordPasswordPassword'
        ])
            ->assertJsonValidationErrors(['social_id']);
    }

    public function test_it_returns_a_token_if_the_credentials_do_match()
    {
        $user = factory(User::class)->create([
            'password' => 'password12'
        ]);

        $this->json('Post', 'api/auth/login', [
            'social_id' => $user->social_id,
            'password' => 'password12'
        ])
            ->assertJsonStructure([
                'meta' => [
                    'token'
                ]
            ]);
    }

    public function test_it_returns_a_user_if_the_credentials_do_match()
    {
        $user = factory(User::class)->create([
            'password' => 'password12'
        ]);

        $this->json('Post', 'api/auth/login', [
            'social_id' => $user->social_id,
            'password' => 'password12'
        ])
            ->assertJsonFragment([
                'social_id' => $user->social_id
            ]);
    }
}
