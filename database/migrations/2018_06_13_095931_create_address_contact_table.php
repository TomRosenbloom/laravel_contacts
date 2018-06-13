<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_contact', function (Blueprint $table) {
            $table->integer('address_id')->unsigned();
            $table->integer('contact_id')->unsigned();
            $table->boolean('is_default')->default(0);
            $table->integer('address_type_id')->nullable();

            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('address_id')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_contact');
    }
}
