<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
  protected $table = "sites";
  protected $primaryKey= "id";
  protected $fillable = ["name","address","longtitude","latitude","isInternal"];

  public function site_currentemployees()
  {
      return $this->hasMany('App\EmployeeSite', 'site_id')->where('leavedate',null);
  }

  public function site_historyemployees()
  {
      return $this->hasMany('App\EmployeeSite', 'site_id')->where('leavedate','!=',null);
  }

  public function site_employee_byDate($date)
  {
    return $this->hasMany('App\EmployeeSite', 'site_id')
                        ->where('startdate','<=',$date)
                        ->where(function($q) use ($date){
                            $q->where(function($query) use ($date) {
                                    $query->where('leavedate','>=', $date)
                                          ->orWhere('leavedate', null);
                                });
                              })

                        ->get();
  }
}
