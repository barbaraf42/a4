<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('addresses', function (Blueprint $table) {

    		# Increments method will make a Primary, Auto-Incrementing field.
    		# Most tables start off this way
    		$table->increments('id');

    		# This generates two columns: `created_at` and `updated_at` to
    		# keep track of changes to a row
    		$table->timestamps();

    		# The rest of the fields...
    		$table->string('place_name');
    		$table->string('street');
    		$table->string('city');
    		$table->string('state');
            $table->string('zip')->nullable();
    		$table->text('map_link');

    		# TAGS.

    	});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('addresses');
    }
}
