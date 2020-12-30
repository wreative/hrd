<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('plus_id');
            $table->string('minus_id');
            $table->string('e_id');
            $table->bigInteger('gaji');
            $table->bigInteger('penerimaan');
            $table->bigInteger('pengurangan');
            $table->bigInteger('total');
            $table->enum('status', ['Pending', 'Sukses', 'Ditolak']);
            $table->string('m_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary');
    }
}
