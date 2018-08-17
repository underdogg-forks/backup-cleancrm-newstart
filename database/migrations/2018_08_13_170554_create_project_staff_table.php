<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectStaffTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_staff', function(Blueprint $table)
		{
			$table->integer('project_id')->unsigned()->index('fk_project_staff_projects_idx');
			$table->integer('staff_id')->unsigned()->index('fk_project_staff_staff_idx');
            $table->timestamps();
            $table->softdeletes();
			$table->primary(['project_id','staff_id']);
			$table->unique(['project_id','staff_id'], 'project_id_UNIQUE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('project_staff');
	}

}
