<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('generate_surats', function (Blueprint $table) {
            $table->id();
            $table->string('nomor1');
            $table->string('nomor2');
            $table->string('nomor3');
            $table->string('nomor4');
            $table->string('tempat');
            $table->date('tanggal');
            $table->string('sifat');
            $table->string('lampiran');
            $table->string('hal');
            $table->string('tujuan');
            $table->text('isi');
            $table->string('pengirim');
            $table->string('jabatan');
            $table->string('nip');
            $table->string('file_path'); // Untuk menyimpan lokasi file PDF
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('generate_surats');
    }
};
