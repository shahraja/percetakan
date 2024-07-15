<?php

namespace Tests\Feature;

use App\Models\Transaksi;
use App\Models\User;
use Database\Factories\BukuFactory;
use Database\Factories\TransaksiFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Iterasi_3_Test extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Melakukan_perhitungan(): void
    {
        $admin = User::where('email', 'admin@admin.com')->first();
        $user = User::where('email', 'user@user.com')->first();
        $response = $this->actingAs($admin)->withSession(['_token' => 'bzz'])->get(route('admin.product.index'));
        $response->assertStatus(200);

        $response2 = $this->actingAs($user)->withSession(['_token' => 'bzz'])->postJson(route('user.kalender.store', [
            'produk_id' => 1,
            'jumlah' => '2',
            'gramasi' => '120',
            'lembar' => 39,
            'jilid' => 'kaleng',
            'laminasi' => 'glossy1',
            'uk_asli' => '79 x 109',
            'uk_width' => 39,5,
            'uk_height' => 54,5,
            '_token' => 'bzz',
        ]));

        $transaksi = Transaksi::oldest()->first();
        $response3 = $this->actingAs($user)->withSession(['_token' => 'bzz'])->get(route('payment', [$transaksi->produk_id, $transaksi->nomor_pesanan, 0], [
            
        ]));

        // $response2->dd();
        $response3->assertStatus(200);
        // $response = $this->withSession(['_token' => 'bzz'])->postJson('/login', []);
    }

    public function test_Melihat_status(): void
    {
        $user = User::where('email', 'user@user.com')->first();
        
        $transaksi = TransaksiFactory::new()->create([
            'user_id' => 2,
        ]);

        $buku = BukuFactory::new()->create([
            'transaksi_id' => $transaksi->id,
        ]);

        $response = $this->actingAs($user)->withSession(['_token' => 'bzz'])->get(route('cart2'));

        $response->assertStatus(200);
    }

}
