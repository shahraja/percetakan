<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login(): void
    {

        $user = User::where('email', 'user@user.com')-> first();
        $response = $this->withSession(['_token' => 'bzz'])
            ->postJson(route('login'), [
                '_token' => 'bzz',
                'email' => 'user@user.com',
                'password' => 'password',
            ]);

        $this->assertAuthenticatedAs($user);
    }
}
