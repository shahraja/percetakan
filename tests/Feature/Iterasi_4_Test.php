<?php

namespace Tests\Feature;

use App\Models\Buku;
use App\Models\Transaksi;
use App\Models\User;
use Database\Factories\BukuFactory;
use Database\Factories\TransaksiFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Iterasi_4_Test extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_Bukti_Pembayaran(): void
    {
        $admin = User::where('email', 'admin@admin.com')->first();
        $user = User::where('email', 'user@user.com')->first();
        $response = $this->actingAs($admin)->withSession(['_token' => 'bzz'])->get(route('admin.payment.index'));
        
        
        $response->assertStatus(200);
    }

     public function test_Pemilihan_Pengiriman(): void
    {
        $admin = User::where('email', 'admin@admin.com')->first();
        $user = User::where('email', 'user@user.com')->first();
        $response = $this->actingAs($admin)->withSession(['_token' => 'bzz'])->get(route('admin.product.index'));
        $response->assertStatus(200);

       $transaksi = TransaksiFactory::new()->create([
           'user_id' => 2,

       ]);
       $buku = BukuFactory::new()->create([
           'transaksi_id' => $transaksi->id,
       ]);

       $response2 = $this->actingAs($user)->withSession(['_token' => 'bzz'])->get(route('payment', [$transaksi->produk_id, $transaksi->nomor_pesanan, 0], [
            
       ]));

       $response2->assertStatus(200);
       
    }
}
