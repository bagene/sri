<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeDepartment extends Model
{
  protected $table = "employee_departments";
  protected $primaryKey= "id";
  protected $fillable = ["employee_id","department_id","startdate",'leavedate'];


  public function department()
   {
       return $this->belongsTo('App\Department', 'department_id');
   }

   public function employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id');
    }



}
