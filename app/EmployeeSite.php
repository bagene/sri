<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSite extends Model
{
  protected $table = "employee_sites";
  protected $primaryKey= "id";
  protected $fillable = ["employee_id","site_id","startdate","leavedate"];


  public function site()
   {
       return $this->belongsTo('App\Site', 'site_id');
   }


  public function employee()
   {
       return $this->belongsTo('App\Employee', 'employee_id');
   }

}
