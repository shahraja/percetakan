<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Iterasi_1_Test extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Login_Kedalam_Sistem_Admin(): void
    {
        $user = User::factory()->create([
            'role' => 1, // 1 = 'admin'
        ]);

        $response = $this->withSession(['_token' => 'bzz'])->postJson('/login', [
            'email' => $user->email,
            'password' => 'password',
            '_token' => 'bzz',
        ]);

        // $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_Login_Kedalam_Sistem_User(): void
    {
        $user = User::factory()->create([
            'role' => 2, // 2 = 'user'
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        // $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    public function test_Admin_Melihat_Pesanan_Masuk(): void
    {
        
        $user = User::where('email', 'admin@admin.com')-> first();
        // $response = $this->post('/login', [
        //     'email' => $user->email,
        //     'password' => 'password',
        // ]);

        $response = $this->actingAs($user)->get(route('admin.cart.index'));
        $response->assertStatus(200);
    }
}
