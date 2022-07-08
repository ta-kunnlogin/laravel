<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PracticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('practices')->insert([
            'date' => '2022-01-01',
            'morning' => '40分jog',
            'type_id_1' => 1,
            'afternoon' => '40分jog',
            'type_id_2' => 1,
            'comment' => 'サンプル1',
            'image' => 'サンプル1',
            'feedback' => 'サンプル1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
