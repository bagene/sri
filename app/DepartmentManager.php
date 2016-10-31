<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentManager extends Model
{
  protected $table = "department_managers";
  protected $primaryKey= "id";
  protected $fillable = ["employee_id","department_id","startdate",'leavedate'];

  public function employee()
   {
       return $this->belongsTo('App\Employee', 'employee_id');
   }

}
