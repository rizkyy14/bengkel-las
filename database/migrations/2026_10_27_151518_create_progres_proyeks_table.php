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
    Schema::create('progres_proyeks', function (Blueprint $table) {
        $table->id('id_progres');
        $table->foreignId('id_pesanan')->constrained('pesanans', 'id_pesanan')->onDelete('cascade');
        $table->foreignId('id_worker')->constrained('users', 'id')->onDelete('cascade');
        $table->integer('persentase'); // 0 - 100
        $table->text('keterangan')->nullable();
        $table->string('foto_progres')->nullable(); // Path gambar di Supabase Storage
        $table->date('tgl_update');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progres_proyeks');
    }
};
