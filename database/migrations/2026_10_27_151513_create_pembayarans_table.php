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
    Schema::create('pembayarans', function (Blueprint $table) {
        $table->id('id_bayar');
        $table->foreignId('id_pesanan')->constrained('pesanans', 'id_pesanan')->onDelete('cascade');
        $table->date('tgl_bayar');
        $table->enum('jenis_bayar', ['DP', 'Pelunasan']);
        $table->double('jumlah_bayar', 15, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
