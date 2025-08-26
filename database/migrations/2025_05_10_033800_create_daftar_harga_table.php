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
        Schema::create('daftar_harga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasar_id')->constrained()->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('daftar_barang')->onDelete('cascade');

            $table->integer('harga');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_harga');
    }
};
