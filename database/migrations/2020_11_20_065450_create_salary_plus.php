<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryPlus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_plus', function (Blueprint $table) {
            $table->bigIncrements('id_plus');
            $table->bigInteger('gaji_pkk');
            $table->bigInteger('uang_hdr');
            $table->bigInteger('tnjgn_trpi');
            $table->bigInteger('lmbr_m');
            $table->bigInteger('lmbr_h');
            $table->bigInteger('lmbr_l');
            $table->bigInteger('lmbr_p_m');
            $table->bigInteger('lmbr_p_l');
            $table->bigInteger('hdr_lk');
            $table->bigInteger('lmbr_lk');
            $table->bigInteger('lylts');
            $table->bigInteger('ddks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_plus');
    }
}
