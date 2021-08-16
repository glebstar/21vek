<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherFieldsInObjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objects', function (Blueprint $table) {
            $table->string('o_region')->default('');
            $table->string('o_locality')->default('');
            $table->string('o_sub_locality')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('objects', function (Blueprint $table) {
            $table->dropColumn(['o_region', 'o_locality', 'o_sub_locality']);
        });
    }
}
