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
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('NoSurat');
            $table->date('TanggalSurat');
            $table->date('TanggalTerima');
            $table->string('Dari');
            $table->string('TingkatKeamanan');
            $table->string('Status');
            $table->string('FileSurat');
            $table->string('Ringkasan');
            $table->string('FileLampiran')->nullable(); // Bisa NULL
            $table->json('tujuan')->nullable(); // Bisa menerima array atau kosong
            $table->string('disposisi')->nullable(); // Bisa NULL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuks');
    }
};
