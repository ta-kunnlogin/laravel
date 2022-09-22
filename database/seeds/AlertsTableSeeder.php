<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlertsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alerts')->insert([
            'date' => '2022-01-01',
            'comment' => '休み',
        ]);
    }
}
