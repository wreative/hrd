<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('position')->insert([
            [
                'id' => '1',
                'name' => 'Direktur',
            ],
            [
                'id' => '2',
                'name' => 'Manager',
            ],
            [
                'id' => '3',
                'name' => 'Koordinator',
            ],
            [
                'id' => '4',
                'name' => 'Staff',
            ],
            [
                'id' => '5',
                'name' => 'Karyawan',
            ],
            [
                'id' => '6',
                'name' => 'Helper',
            ],
            [
                'id' => '7',
                'name' => 'Driver',
            ],
            [
                'id' => '8',
                'name' => 'Office Boy',
            ],
            [
                'id' => '9',
                'name' => 'Kitchen',
            ],
            [
                'id' => '10',
                'name' => 'Gudang',
            ],
            [
                'id' => '11',
                'name' => 'Operator',
            ],
        ]);
    }
}
