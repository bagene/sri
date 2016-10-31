<?php

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

    Schema::create('employees', function (Blueprint $table) {
        $table->string('id')->primary();
        $table->string('ss_number')->unique();
        $table->string('business_phonenumber');
        $table->string('business_faxnumber');
        $table->string('business_email');
        $table->boolean('isInternal');
        $table->string('fname');
        $table->string('lname');
        $table->string('street');
        $table->string('housenumber');
        $table->integer('postalcode');
        $table->string('city');
        $table->char('gender');
        $table->date('birthdate');
        $table->string('email');
        $table->string('telephonenumber');
        $table->string('faxnumber');
        $table->string('mobilenumber');
        $table->binary('image');
        $table->date('entrydate');
        $table->date('leavedate')->nullable();
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
      Schema::drop('employees');
  }
}
