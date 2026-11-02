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
    Schema::create('detail_bahans', function (Blueprint $table) {
        $table->id('id_detail');
        $table->foreignId('id_pesanan')->constrained('pesanans', 'id_pesanan')->onDelete('cascade');
        $table->foreignId('id_bahan')->constrained('bahan_bakus', 'id_bahan')->onDelete('cascade');
        $table->integer('jumlah_terpakai');
        $table->double('subtotal_harga', 15, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_bahans');
    }
};
