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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outlet_id')->constrained('outlets');
            $table->foreignId('member_id')->constrained('members');
            $table->date('tanggal');
            $table->date('batas_waktu');
            $table->date('tanggal_bayar');
            $table->bigInteger('biaya_tambahan')->nullable();
            $table->bigInteger('diskon')->nullable();
            $table->bigInteger('pajak')->nullable();
            $table->enum('status', ['Baru', 'Proses', 'Selesai', 'Diambil']);
            $table->enum('dibayar', ['Dibayar', 'Belum-Bayar']);
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
