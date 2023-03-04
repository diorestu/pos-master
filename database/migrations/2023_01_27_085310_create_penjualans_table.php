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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_jual');
            $table->string('kode_penjualan', 100);
            $table->string('no_po', 100)->nullable();
            // $table->foreignId('id_pembayaran1')->constrained('metode_pembayarans');
            // $table->double('total_bayar1', 15, 0)->nullable();
            // $table->foreignId('id_pembayaran2')->constrained('metode_pembayarans');
            // $table->double('total_bayar2', 15, 0)->nullable();
            $table->double('total', 15, 0)->nullable();
            $table->double('diskon', 15, 0)->nullable();
            $table->double('grand_total', 15, 0)->nullable();
            $table->boolean('is_lunas')->nullable();
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
        Schema::dropIfExists('penjualans');
    }
};
