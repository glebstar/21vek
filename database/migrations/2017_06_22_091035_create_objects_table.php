<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name')->default('');
            $table->string('phone')->default('');
            $table->string('category');
            $table->string('sub_locality_name');
            $table->string('address');
            $table->integer('area')->default(0);
            $table->integer('lot_area')->default(0);
            $table->integer('rooms')->default(0);
            $table->integer('floor')->default(0);
            $table->integer('floors_total')->default(0);
            $table->integer('built_year')->default(0);
            $table->string('renovation');
            $table->string('deal_status');
            $table->text('description');
            $table->integer('creation_date')->unsigned();
            $table->integer('last_update_date')->unsigned();
            $table->boolean('is_trash')->default(0);
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
        Schema::drop('objects');
    }
}
