<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->string('name', 45)->unique('name_unique');
			$table->string('slug', 45)->unique('slug_unique');
			$table->date('start_date')->nullable();
			$table->date('due_date')->nullable();
            $table->timestamps();
            $table->softdeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('projects');
	}

}
