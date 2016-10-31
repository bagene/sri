<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeDepartmentTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {

    Schema::create('employee_departments', function (Blueprint $table) {
        $table->increments('id');
        $table->string('employee_id');
        $table->integer('department_id')->unsigned();
        $table->date('startdate');
        $table->date('leavedate')->nullable();
        $table->timestamps();

        $table->foreign('employee_id')->references('id')->on('employees')
                      ->onDelete('cascade');

        $table->foreign('department_id')->references('id')->on('departments')
                      ->onDelete('cascade');

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::drop('employee_departments');
  }
}
