<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDedication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dedication', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('absen');
            $table->bigInteger('waktu');
            $table->bigInteger('uniform');
            $table->bigInteger('sop');
            $table->bigInteger('tj');
            $table->bigInteger('kt');
            $table->bigInteger('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dedication');
    }
}
