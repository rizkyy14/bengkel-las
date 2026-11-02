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
    Schema::create('pesanans', function (Blueprint $table) {
        $table->id('id_pesanan');
        $table->foreignId('id_pelanggan')->constrained('pelanggan', 'id_pelanggan')->onDelete('cascade');
        $table->date('tgl_pesan');
        $table->string('jenis_produk'); // Kanopi, Pagar, Teralis, Railing
        $table->text('spesifikasi');
        $table->double('total_biaya', 15, 2)->default(0);
        $table->enum('status_pesanan', ['Draft', 'Proses', 'Selesai'])->default('Draft');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
