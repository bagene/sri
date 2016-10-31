<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
  protected $table = "employees";
  protected $primaryKey = "id";
  public $incrementing = false;
  protected $fillable = [
    'id',
    'ss_number',
    'business_phonenumber',
    'business_faxnumber',
    'business_email',
    'isInternal',
    'fname',
    'lname',
    'street',
    'housenumber',
    'postalcode',
    'city',
    'gender',
    'birthdate',
    'email',
    'telephonenumber',
    'faxnumber',
    'mobilenumber',
    'image',
    'entrydate',
    'leavedate'
  ];

  public function employee_departments()
   {
       return $this->hasMany('App\EmployeeDepartment', 'employee_id')->orderBy('startdate','DESC');
   }

   public function employee_sites()
    {
        return $this->hasMany('App\EmployeeSite', 'employee_id')->orderBy('startdate','DESC');
    }

}
