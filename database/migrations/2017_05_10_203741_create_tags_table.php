<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tags', function (Blueprint $table) {

    		# Increments method will make a Primary, Auto-Incrementing field.
    		$table->increments('id');

    		# This generates two columns: `created_at` and `updated_at` to
    		# keep track of changes to a row
    		$table->timestamps();

    		# The rest of the fields...
    		$table->string('tag_name');

    	});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tags');
    }
}
