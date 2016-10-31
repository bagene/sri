<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeSiteTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {

    Schema::create('employee_sites', function (Blueprint $table) {
        $table->increments('id');
        $table->string('employee_id');
        $table->integer('site_id')->unsigned();
        $table->date('startdate');
        $table->date('leavedate')->nullable();
        $table->timestamps();

        $table->foreign('employee_id')->references('id')->on('employees')
                      ->onDelete('cascade');

        $table->foreign('site_id')->references('id')->on('sites')
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
      Schema::drop('employee_sites');
  }
}
