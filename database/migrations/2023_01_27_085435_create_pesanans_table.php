<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Integer;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan', 100);
            $table->date('tgl_pesan')->nullable();
            $table->date('tgl_ambil')->nullable();
            $table->string('nama_customer', 120)->nullable();
            $table->string('email_customer', 100)->nullable();
            $table->string('nama_penerima', 120)->nullable();
            $table->string('via_pemesanan', 100)->nullable();
            $table->string('phone1', 20)->nullable();
            $table->string('phone2', 20)->nullable();
            $table->double('bayar_dp', 15, 0)->nullable();
            $table->double('total_bayar', 15, 0)->nullable();
            $table->integer('id_pembayaran')->unsigned()->nullable();
            $table->boolean('is_ambil')->nullable();
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
        Schema::dropIfExists('pesanans');
    }
};
