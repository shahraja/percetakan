<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrosurTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_brosur(): void
    {
        $user = User::where('email', 'user@user.com')-> first();
        $response = $this->actingAs($user)
        ->withSession(['_token' => 'bzz'])
        ->postJson(route('user.buku.store'), [
                '_token' => 'bzz',
                "jumlah" => "65",
                "ukuran" => "plano2",
                "gramasi" => "190",
                "laminasi" => "doff2",
                "uk_asli" => "65 x 90",
                "uk_width" => "32.5",
                "uk_height" => "45",
                "produk_id" => "Brosur",

            ]);

        $response->assertStatus(422);
    }
}
