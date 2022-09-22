<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            'date' => '2022年第15週',
            'Monday'=>'40分ジョグ/60分jog',
            'Tuesday'=>'40分ジョグ/60分jog',
            'Wednesday'=>'40分ジョグ/60分jog',
            'Thursday'=>'40分ジョグ/60分jog',
            'Friday'=>'40分ジョグ/60分jog',
            'Saturday'=>'40分ジョグ/60分jog',
            'Sunday'=>'40分ジョグ/60分jog',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
