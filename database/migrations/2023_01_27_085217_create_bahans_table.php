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
        Schema::create('bahans', function (Blueprint $table) {
            $table->id();
            $table->text('nama')->nullable();
            $table->foreignId('id_satuan')->constrained('satuan_barangs');
            $table->foreignId('id_supplier')->constrained('suppliers');
            $table->double('harga_beli', 15, 0)->nullable();
            $table->double('stok_minimum', 15, 0)->nullable();
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
        Schema::dropIfExists('bahans');
    }
};
