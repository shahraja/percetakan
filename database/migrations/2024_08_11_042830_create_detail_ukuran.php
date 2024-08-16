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
        Schema::create('detail_ukuran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ukuran_id')->references('id')->on('ukuran')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_detail_ukuran');
            $table->boolean('is_parent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_ukuran');
    }
};
