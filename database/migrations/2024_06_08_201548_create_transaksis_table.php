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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nomor_pesanan');
            $table->string('nama_produk');
            $table->string('alamat');
            $table->string('total_harga');
            $table->string('harga_plano');
            $table->string('jml_total');
            $table->string('gramasi');
            $table->string('laminasi');
            $table->string('gambar');
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
