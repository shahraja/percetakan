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
        Schema::create('transaksi_undangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->constrained('transaksi_kalender');
            $table->string('alamat')->nullable();
            $table->integer('total_harga')->nullable();
            $table->integer('harga_plano')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('gramasi')->nullable();
            $table->enum('status',['Ditolak','Diproses','Menunggu Pembayaran', 'Telah Dikonfirmasi', 'Selesai',])->default('Menunggu Pembayaran');
            $table->string('laminasi')->nullable();
            $table->string('uk_asli')->nullable();
            $table->string('uk_width')->nullable();
            $table->string('uk_height')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_undangan');
    }
};
