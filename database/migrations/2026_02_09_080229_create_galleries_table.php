<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul Foto
            $table->string('slug')->unique(); // Untuk URL yang rapi (contoh: gallery/foto-pemandangan)
            $table->string('category'); // Nature, People, Architecture, dll
            $table->string('image'); // Nama file gambar yang disimpan di storage
            $table->text('description')->nullable(); // Deskripsi foto
            $table->timestamps(); // create_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
