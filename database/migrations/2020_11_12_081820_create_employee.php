<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('kode');
            $table->string('nama');
            $table->enum('jk', ['Laki-Laki', 'Perempuan']);
            $table->string('photo')->nullable();
            $table->enum('status', ['Aktif', 'Pasif', 'Pelamar', 'Pending', 'Cancel']);
            $table->string('keterangan')->nullable();
            $table->string('rek')->nullable();
            $table->string('detail');
            $table->string('kontrak');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}
