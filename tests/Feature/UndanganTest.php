<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UndanganTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::where('email', 'user@user.com')-> first();
        $response = $this->actingAs($user)
        ->withSession(['_token' => 'bzz'])
        ->postJson(route('user.buku.store'), [
                '_token' => 'bzz',
                "jumlah" => "48",
                "ukuran" => "plano1",
                "gramasi" => "150",
                "laminasi" => "doff1",
                "uk_asli" => "61 x 92",
                "uk_width" => "30.5",
                "uk_height" => "46",
                "produk_id" => "Undangan",

            ]);

        $response->assertStatus(422);
    }
}
