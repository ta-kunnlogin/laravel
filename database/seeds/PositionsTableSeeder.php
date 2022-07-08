<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            ['name' => 'コーチ',],
            ['name' => '選手',]
        ];

        foreach ($params as $param) {
            DB::table('positions')->insert($param);
        }
    }
}
