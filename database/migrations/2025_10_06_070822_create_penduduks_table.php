<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk')->nullable()->after('id');
            $table->foreignId('rumah_id')->constrained('rumah')->cascadeOnDelete();
            $table->string('nik')->unique()->nullable();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->enum('status_keluarga', ['Kepala Keluarga', 'Istri', 'Anak'])->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('penduduk');
    }
};

