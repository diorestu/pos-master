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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_supplier', 120)->nullable();
            $table->string('nama_pic', 100)->nullable();
            $table->string('phone_supplier1', 30)->nullable();
            $table->string('phone_supplier2', 30)->nullable();
            $table->text('alamat')->nullable();
            $table->string('rekening_nomor', 30)->nullable();
            $table->string('rekening_nama', 30)->nullable();
            $table->string('rekening_bank', 30)->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
};
