<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alat_id')->constrained('alats')->onDelete('cascade');
            $table->date('tanggal_maintenance');
            $table->enum('jenis', ['Perawatan Rutin', 'Perbaikan']);
            $table->text('deskripsi')->nullable();
            $table->decimal('biaya', 12, 2)->nullable();
            $table->string('teknisi')->nullable();
            $table->enum('status', ['Proses', 'Selesai'])->default('Proses');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
