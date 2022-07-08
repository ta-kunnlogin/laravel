<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conditions')->insert([
            'date' => '2022-01-01',
            'condition'=>'アキレス腱の炎症',
            'comment' => '痛い',
            'feedback' => 'サンプル1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
