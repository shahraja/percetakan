<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->string('no_pesanan');
            $table->string('nama');
            $table->string('alamat');
            $table->string('nama_produk');
            $table->string('sisi');
            $table->string('ukuran');
            $table->integer('jumlah_total');
            $table->string('lipat');
            $table->string('harga');
            $table->string('laminasi');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
