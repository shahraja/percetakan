<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MajalahTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_majalah(): void
    {
        $user = User::where('email', 'user@user.com')-> first();
        $response = $this->actingAs($user)
        ->withSession(['_token' => 'bzz'])
        ->postJson(route('user.buku.store'), [
                '_token' => 'bzz',
                "jumlah" => "60",
                "ukuran" => "A5",
                "gramasi" => "150",
                "halaman" => "73",
                "finishing" => "binding",
                "laminasi" => "doff1",
                "uk_asli" => "65 x 90",
                "uk_width" => "14.8",
                "uk_height" => "21",
                "produk_id" => "Majalah",

            ]);

        $response->assertStatus(200);
    }
}
