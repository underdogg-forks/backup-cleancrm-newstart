<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RolesExtraFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('roles', function ($table) {
          //->unique('slug_unique')
            $table->string('slug', 45)->after('name'); //the after method is optional.
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::table('roles', function ($table) {
        $table->dropColumn('slug');
    });
    }
}
