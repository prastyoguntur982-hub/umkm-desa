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
        // database/migrations/2025_xx_xx_create_umkms_table.php
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('nama_pemilik');
            // Kategori UMKM
            $table->string('kategori')->default('lainnya'); // default supaya tidak null
            $table->text('deskripsi')->nullable();
            $table->text('lokasi')->nullable();



            // Link marketplace
            $table->string('link_wa')->nullable();
            $table->string('link_shopee')->nullable();
            $table->string('link_tokopedia')->nullable();
            $table->string('link_tiktok')->nullable();

            // Primary photo
            $table->string('primary_photo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
