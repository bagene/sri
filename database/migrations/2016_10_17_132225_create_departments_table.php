<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {

    Schema::create('departments', function (Blueprint $table) {
        $table->increments('id');
        $table->string('department_acronym')->unique();
        $table->string('name');
        $table->integer('parent_id');
        $table->timestamps(); // create the created_at and updated_at field
    });

  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::drop('departments');
  }
}
