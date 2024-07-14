<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KalenderTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_kalender(): void
    {
        $user = User::where('email', 'user@user.com')-> first();
        $response = $this->actingAs($user)
        ->withSession(['_token' => 'bzz'])
        ->postJson(route('user.buku.store'), [
                '_token' => 'bzz',
                "jumlah" => "66",
                "ukuran" => "plano7",
                "gramasi" => "150",
                "lembar" => "33",
                "jilid" => "spiral",
                "laminasi" => "doff2",
                "uk_asli" => "72 x 104",
                "uk_width" => "36",
                "uk_height" => "52",
                "produk_id" => "Kalender",

            ]);

        $response->assertStatus(422);
    }
}
