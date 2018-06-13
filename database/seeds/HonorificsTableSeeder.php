<?php

use Illuminate\Database\Seeder;

class HonorificsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $honorifics = array(
            ['name'=>'Mr'],
            ['name'=>'Ms'],
            ['name'=>'Mrs'],
            ['name'=>'Miss'],
            ['name'=>'Dr'],
        );
        DB::table('honorifics')->insert($honorifics);
    }
}
