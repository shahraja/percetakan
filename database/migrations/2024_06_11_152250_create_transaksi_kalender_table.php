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
        Schema::create('transaksi_kalender', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->constrained('transaksi_kalender');
            $table->string('alamat');
            $table->integer('total_harga');
            $table->integer('harga_plano');
            $table->integer('jumlah');
            $table->string('gramasi');
            $table->enum('status',['Ditolak','Diproses','Menunggu Pembayaran', 'Telah Dikonfirmasi', 'Selesai',])->default('Menunggu Pembayaran');
            $table->integer('isi');
            $table->string('jilid');
            $table->string('laminasi');
            $table->string('uk_asli');
            $table->string('uk_width');
            $table->string('uk_height');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_kalender');
    }
};
