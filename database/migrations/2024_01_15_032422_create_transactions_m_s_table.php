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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produk');
            $table->string('nama_pelanggan', 45);
            $table->string('nomor_unik', 10)->unique();
            $table->integer('uang_bayar');
            $table->integer('uang_kembali');
            $table->enum('pembayaran',['Lunas','Belum Lunas']);
            $table->date('est_selesai');
            $table->enum('status_pengerjaan',['Baru','Proses','Selesai','Diambil']);
            $table->timestamps();
  
            $table->foreign('id_produk')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
