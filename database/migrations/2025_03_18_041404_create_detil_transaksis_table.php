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
    Schema::create('detil_transaksis', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('transaksi_id'); // Pastikan tipe datanya sesuai
        $table->unsignedBigInteger('produk_id'); // Pastikan tipe datanya sesuai
        $table->integer('jumlah'); // Tambahkan jumlah produk
        $table->timestamps();

        $table->foreign('transaksi_id')->references('id')->on('transaksis')->onDelete('cascade');
        $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detil_transaksis');
    }
};
