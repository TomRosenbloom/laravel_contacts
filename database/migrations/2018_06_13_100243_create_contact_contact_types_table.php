<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactContactTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_contact_types', function (Blueprint $table) {
            $table->integer('contact_type_id')->unsigned();
            $table->integer('contact_id')->unsigned();

            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('contact_type_id')->references('id')->on('contact_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_contact_types');
    }
}
