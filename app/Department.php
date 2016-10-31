<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "departments";
    protected $primaryKey= "id";
    protected $fillable = ["department_acronym","name","parent_id"];

    public function parent()
     {
         return $this->belongsTo('App\Department', 'parent_id');
     }

     public function children()
     {
         return $this->hasMany('App\Department', 'parent_id');
     }

     public function department_currentemployees()
     {
         return $this->hasMany('App\EmployeeDepartment', 'department_id')->where('leavedate',null)->orderBy('startdate','DESC');
     }

     public function department_historyemployees()
     {
         return $this->hasMany('App\EmployeeDepartment', 'department_id')->where('leavedate','!=',null)->orderBy('startdate','DESC');
     }

     public function currentmanager()
     {
         return $this->hasOne('App\DepartmentManager', 'department_id')->where('leavedate',null);
     }


     public function department_historymanagers()
     {
         return $this->hasMany('App\DepartmentManager', 'department_id')->where('leavedate','!=',null)->orderBy('startdate','DESC');
     }

     public function currentmanager_bydate($date)
     {
         return $this->hasOne('App\DepartmentManager', 'department_id')
                       ->where('startdate','<=',$date)
                       ->where(function($q) use ($date){
                           $q->where(function($query) use ($date) {
                                   $query->where('leavedate','>=', $date)
                                         ->orWhere('leavedate', null);
                               });
                             })

                       ->first();
     }



      public function department_employees_bydate($date)
      {

          return $this->hasMany('App\EmployeeDepartment', 'department_id')
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
