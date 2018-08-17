<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_roles', function(Blueprint $table)
		{
            $table->integer('project_id')->unsigned();
            $table->integer('staff_id')->unsigned();
			$table->string('name', 45)->unique('name_UNIQUE');
			$table->string('slug', 45)->unique('slug_UNIQUE');
            $table->timestamps();
            $table->softdeletes();
			$table->primary(['project_id','staff_id']);
			$table->index(['project_id','staff_id'], 'fk_project_roles_staff_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('project_roles');
	}

}
