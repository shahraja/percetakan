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
        Schema::create('detail_value_ukuran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('detail_ukuran_id')->references('id')->on('detail_ukuran')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_value_ukuran');
            $table->integer('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_value_ukuran');
    }
};
