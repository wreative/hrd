<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailed', function (Blueprint $table) {
            // $table->bigIncrements('kode');
            $table->id();
            $table->enum('divisi', [
                'Accounting',
                'Admin',
                'Supplier',
                'Koperasi',
                'IT Cyber',
                'Freelance',
                // Food
                'Soto',
                'Steak',
                // Aplikator
                'Konstruksi',
                'Produksi',
                // Almaas
                'Dakwah',
                'Sosial',
                'Usaha',
                // Express
                'Internal',
                'Eksternal'
            ]);
            $table->enum('jabatan', [
                'Direktur',
                'Manager',
                'Koordinator',
                'Staff',
                'Karyawan',
                'Helper',
                'Driver',
                'Office Boy',
                'Kitchen',
                'Gudang',
                'Operator',
            ]);
            $table->string('alamat');
            $table->string('kota');
            $table->string('tmp_lahir');
            $table->date('tgl_lahir');
            $table->string('tlp');
            $table->string('lama_bulan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detailed');
    }
}
