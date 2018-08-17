<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectRelationTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_relation_types', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->string('name', 45)->nullable();
			$table->string('slug', 45)->nullable();
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
		Schema::drop('project_relation_types');
	}

}
