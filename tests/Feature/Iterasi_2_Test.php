<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class Iterasi_2_Test extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Mengedit_informasi_katalog(): void
    {
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $user = User::where('email', 'admin@admin.com')->first();
        $response = $this->actingAs($user)->withSession(['_token' => 'bzz'])->postJson(route('admin.product.update', 1), [
            'judul' => 'Judul Baru',
            'gambar' => $file,
            'deskripsi' => 'Deskripsi Baru',
            '_token' => 'bzz',
        ]);
        $produk = Product::where('id', 1)->first();
        $this->assertEquals($produk->deskripsi, 'Deskripsi Baru');

        // $response->assertStatus(200);
    }

    public function test_Melihat_katalog(): void
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

        // $response2->dd();
        $response2->assertStatus(200);
        // $response = $this->withSession(['_token' => 'bzz'])->postJson('/login', []);
    }
}
