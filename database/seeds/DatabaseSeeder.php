<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(HonorificsTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(Contact_typesTableSeeder::class);
        $this->call(HonorificsTableSeeder::class);
        $this->call(Address_typesTableSeeder::class);
    }
}
