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
        Schema::create('transaksi_majalah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id')->nullable();
            $table->foreign('transaksi_id')->references('id')->on('transaksi')
                ->constrained('transaksi')->onDelete('cascade')->onUpdate('cascade');
            $table->string('uk_asli')->nullable();
            $table->string('uk_width')->nullable();
            $table->string('uk_height')->nullable();
            $table->integer('halaman')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_majalah');
    }
};
