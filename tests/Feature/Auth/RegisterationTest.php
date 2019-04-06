<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterationTest extends TestCase
{
    public function test_it_requires_a_social_id()
    {
        $this->json('POST', 'api/auth/register')
            ->assertJsonValidationErrors('social_id');

    }

    public function test_it_requires_a_valid_social_id()
    {
        $this->json('POST', 'api/auth/register', [
            'social_id' => '1398548039'
        ])
            ->assertJsonValidationErrors('social_id');

    }

    public function test_it_requires_a_phone()
    {
        $this->json('POST', 'api/auth/register')
            ->assertJsonValidationErrors('phone');

    }

    public function test_it_requires_a_unique_social_id()
    {
        $user = factory(User::class)->create();

        $this->json('POST', 'api/auth/register', [
            'social_id' => $user->social_id
        ])
            ->assertJsonValidationErrors('social_id');
    }

    public function test_it_requires_a_unique_phone()
    {
        $user = factory(User::class)->create();

        $this->json('POST', 'api/auth/register', [
            'phone' => $user->phone
        ])
            ->assertJsonValidationErrors('phone');
    }

    public function test_it_requires_a_password()
    {
        $this->json('POST', 'api/auth/register')
            ->assertJsonValidationErrors('password');
    }

    public function test_it_requires_a_confirm_password()
    {
        $this->json('POST', 'api/auth/register')
            ->assertJsonValidationErrors('confirm_password');
    }


    //I have to find another way for this test not really good
    public function test_it_checks_password_and_confirm_password_are_equals()
    {
        $this->json('POST', 'api/auth/register',[
            'password' => 'password12',
            'confirm_password' => 'password12'
        ])
            ->assertJsonMissingValidationErrors('confirm_password', 'password');
    }

    public function test_it_registers_a_user()
    {
        $this->json('Post', 'api/auth/register', [
            'social_id' => $social_id = '1398548030',
            'phone' => $phone = '09354584063',
            'password' => 'password12',
            'confirm_password' => 'password12'
        ])
            ->assertJsonFragment([
                'social_id' => $social_id,
                'phone' => (string) $phone,
            ]);
    }


}
