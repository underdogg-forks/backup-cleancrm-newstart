<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('employees', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('relation_id')->unsigned()->index('fk_employees_relations_idx');
			$table->string('first_name', 45)->nullable();
			$table->string('middle_name', 45)->nullable();
			$table->string('last_name', 45)->nullable();
			$table->string('bsn', 45)->nullable();
			$table->string('idnr', 45)->nullable()->unique('idnr_unique');
      $table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('employees');
    }
}
