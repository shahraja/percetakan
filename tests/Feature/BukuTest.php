<?php

namespace Tests\Feature;

use App\Models\Buku;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BukuTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_buku(): void
    {
        $user = User::where('email', 'user@user.com')-> first();
        $response = $this->actingAs($user)
        ->withSession(['_token' => 'bzz'])
        ->postJson(route('user.buku.store'), [
                '_token' => 'bzz',
                "jumlah" => "67",
                "ukuran" => "A4",
                "gramasi" => "120",
                "halaman" => "5",
                "finishing" => "staples",
                "laminasi" => "glossy1",
                "uk_asli" => "61 x 92",
                "uk_width" => "21",
                "uk_height" => "28",
                "produk_id" => "Buku",
            ]);

        $response->assertStatus(200);
    }
}
