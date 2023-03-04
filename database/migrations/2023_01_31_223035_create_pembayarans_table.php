<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_bayar')->nullable();
            $table->foreignId('id_pesanan')->constrained('pesanans')->nullable();
            $table->foreignId('id_penjualan')->constrained('penjualans')->nullable();
            $table->foreignId('id_pembayaran')->constrained('metode_pembayarans');
            $table->double('total_bayar', 15, 0)->nullable();
            $table->boolean('is_active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
};
