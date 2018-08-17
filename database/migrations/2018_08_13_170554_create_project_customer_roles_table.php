<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectCustomerRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_customer_roles', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('customer_id')->unsigned()->unique('customer_id_UNIQUE');
			$table->integer('projects_id')->unsigned()->index('fk_project_customer_roles_projects');
			$table->integer('project_role_id')->unsigned();
			$table->string('name', 10)->nullable();
			$table->string('slug', 10)->nullable();
            $table->timestamps();
            $table->softdeletes();
			$table->index(['project_role_id','name','slug'], 'fk_project_customer_roles_project_role_idx');
			$table->index(['customer_id','projects_id'], 'fk_project_customer_roles_projects_project_id_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('project_customer_roles');
	}

}
