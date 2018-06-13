<?php

use Illuminate\Database\Seeder;

class Address_typesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = array(
            ['name'=>'Home'],
            ['name'=>'Work'],
            ['name'=>'Billing'],
        );
        DB::table('citys')->insert($types);
    }
}
