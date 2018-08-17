<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectRelationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_relations', function(Blueprint $table)
		{
			$table->integer('project_id')->unsigned();
			$table->integer('relation_id')->unsigned()->index('fk_projects_relation_idx');
			$table->integer('project_role_id')->unsigned()->index('fk_project_relations_project_role_idx');
			$table->integer('project_relation_type')->unsigned()->index('fk_project_relations_project_relation_type_idx');
            $table->timestamps();
            $table->softdeletes();
			$table->primary(['project_id','relation_id','project_role_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('project_relations');
	}

}
