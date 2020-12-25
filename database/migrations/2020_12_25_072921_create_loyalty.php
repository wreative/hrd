<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyalty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyalty', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('amanah');
            $table->bigInteger('produktif');
            $table->bigInteger('tw');
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
        Schema::dropIfExists('loyalty');
    }
}
