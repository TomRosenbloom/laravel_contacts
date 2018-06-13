<?php

use Illuminate\Database\Seeder;

class Contact_typesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = array(
            ['name'=>'Customer'],
            ['name'=>'Supplier'],
        );
        DB::table('citys')->insert($types);
    }
}
