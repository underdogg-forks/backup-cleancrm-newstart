<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PermissionsExtraFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//->unique('slug_unique')
        Schema::table('permissions', function ($table) {
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
    Schema::table('permissions', function ($table) {
        $table->dropColumn('slug');
    });
    }
}
