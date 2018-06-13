<?php

use Illuminate\Database\Seeder;

class CitysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = array(
            ['name'=>'Exeter'],
            ['name'=>'Bristol'],
            ['name'=>'Plymouth'],
            ['name'=>'London'],
            ['name'=>'New York'],
        );
        DB::table('citys')->insert($cities);
    }
}
