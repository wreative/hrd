<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ld', function (Blueprint $table) {
            $table->id();
            $table->date('tgl');
            $table->string('rank');
            $table->string('d_id');
            $table->string('l_id');
            $table->bigInteger('loyalitas');
            $table->bigInteger('dedikasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ld');
    }
}
