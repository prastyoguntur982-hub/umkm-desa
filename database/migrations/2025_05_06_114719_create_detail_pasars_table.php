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
        Schema::create('detail_pasars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasar_id')->constrained('pasars')->onDelete('cascade');
            $table->string('kategori'); 
            $table->string('keterangan'); 
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pasars');
    }
};
