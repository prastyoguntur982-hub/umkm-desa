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
        Schema::create('dokumen_pasars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasar_id')->constrained()->onDelete('cascade');
            $table->string('judul', 255);
            $table->string('deskripsi', 255);
            $table->string('berkas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_pasars');
    }
};
