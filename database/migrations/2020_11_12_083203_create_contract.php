<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContract extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract', function (Blueprint $table) {
            // $table->bigIncrements('kode');
            $table->id();
            $table->date('tgl_masuk');
            $table->date('akhir_kontrak');
            $table->integer('gaji');
            $table->string('no_jaminan')->nullable();
            $table->string('jenis_jaminan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract');
    }
}
