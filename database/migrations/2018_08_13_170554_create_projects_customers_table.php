<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects_customers', function(Blueprint $table)
		{
			$table->integer('customer_id')->unsigned()->index('fk_projects_customers_customers_idx');
			$table->integer('projects_id')->unsigned()->index('fk_projects_customers_projects_idx');
			$table->string('name', 45)->nullable();
            $table->timestamps();
            $table->softdeletes();
			$table->primary(['customer_id','projects_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('projects_customers');
	}

}
