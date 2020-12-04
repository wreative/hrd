<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryMinus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_minus', function (Blueprint $table) {
            $table->bigIncrements('id_minus');
            $table->bigInteger('telat');
            $table->bigInteger('tdk_hdr_a');
            $table->bigInteger('tdk_hdr_s');
            $table->bigInteger('tdk_hdr_i');
            $table->bigInteger('tdk_hdr_b');
            $table->bigInteger('ka');
            $table->bigInteger('ik');
            $table->bigInteger('tk');
            $table->bigInteger('t1');
            $table->bigInteger('t2');
            $table->bigInteger('t3');
            $table->bigInteger('t4');
            $table->bigInteger('ak');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_minus');
    }
}
