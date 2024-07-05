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
            $table->unsignedBigInteger('transaksi_id');
            $table->foreign('transaksi_id')->references('id')->on('transaksi')
                ->constrained('transaksi')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('lembar')->nullable();
            $table->string('jilid')->nullable();
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
        Schema::dropIfExists('transaksi_kalender');
    }
};
