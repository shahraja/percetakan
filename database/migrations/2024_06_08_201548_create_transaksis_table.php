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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nomor_pesanan')->nullable();
            $table->foreignId('produk_id')->references('id')->on('product')->onDelete('cascade')->onUpdate('cascade');
            $table->string('alamat')->nullable();
            $table->string('total_harga')->nullable();
            $table->string('harga_plano')->nullable();
            $table->string('jml_total')->nullable();
            $table->string('gramasi')->nullable();
            $table->string('laminasi')->nullable();
            $table->string('gambar')->nullable();
            $table->boolean('metode_pengambilan')->default(false);
            $table->enum('status',['Ditolak','Diproses','Menunggu Pembayaran', 'Telah Dikonfirmasi', 'Selesai',])->default('Menunggu Pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
