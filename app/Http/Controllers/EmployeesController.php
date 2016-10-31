<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Employee; // Employee Model
use App\Department;
use App\Site;
use App\EmployeeDepartment;
use App\EmployeeSite;
use Session;


class EmployeesController extends Controller
{
  public function __construct(){
    $this->middleware(['auth','admin']);
  }

  public function index(){

    $search = \Request::get('search'); //<-- we use global request to get the param of URI

    $employees = Employee::where('fname','like','%'.$search.'%')
        ->orWhere('lname','like','%'.$search.'%')
        ->orderBy('lname')
        ->paginate(5);

    return view('employees.index',compact('employees'));
  }

  public function create(){

    return view('employees.create');
  }

  public function edit($id){


    $employee = Employee::findOrFail($id);
    $departments = Department::lists('name', 'id');
    $sites = Site::lists('name', 'id');
    return view('employees.edit',compact('employee','departments','sites'));
  }


  public function store(Request $request){

    $this->validate($request,[
      'id' => 'required|unique:employees,id',
      'ss_number' => 'required|unique:employees,ss_number',
      'fname' => 'required',
      'lname' => 'required'
    ]);

    $input = $request->all();
    $lastinsertedID = Employee::create($input)->id;
    Session::flash('flash_message','Employee Successfully Created');
    return redirect()->route('employees.edit',$lastinsertedID);

  }

  public function storedepartment($id,Request $request){

    $this->validate($request,[
      'department_id' => 'required',
      'startdate' => 'required'
    ]);

    $input = $request->all();
    $input['employee_id'] = $id;

    $department = EmployeeDepartment::where('employee_id',$id)
                ->where('department_id',$input['department_id'])
                ->where('leavedate',null)->first();

    if ($department==null) {
      # save the selected department
      EmployeeDepartment::create($input);
      Session::flash('flash_message','Employee Department Successfully Created');
    }else{
      Session::flash('flash_warning','Employee is Already Assigned to that Department');

    }

    return redirect()->back();

  }

  public function storesite($id,Request $request){
    $this->validate($request,[
      'site_id' => 'required',
      'startdate' => 'required'
    ]);

    $input = $request->all();
    $input['employee_id'] = $id;

    $site = EmployeeSite::where('employee_id',$id)
                ->where('site_id',$input['site_id'])
                ->where('leavedate',null)->first();

    if ($site==null) {
      # save the selected site
      EmployeeSite::create($input);
      Session::flash('flash_message','Employee Site Successfully Created');
    }else{
      Session::flash('flash_warning','Employee is Already Assigned to that Site');

    }



    return redirect()->back();

  }

  public function leavesite($id){


    $input['leavedate']=\Carbon\Carbon::now();
    $employee_site = EmployeeSite::findOrFail($id);

    if ($employee_site != null) {

      $employee_site->fill($input)->save();
      Session::flash('flash_message','Employee Site Leave Successfully Updated');
    }else{
      abort(404);
    }


      return redirect()->back();

  }

  public function leavedepartment($id){


    $input['leavedate']=\Carbon\Carbon::now();
    $employee_department = EmployeeDepartment::findOrFail($id);

    if ($employee_department != null) {

      $employee_department->fill($input)->save();
      Session::flash('flash_message','Employee Department Leave Successfully Updated');
    }else{
      abort(404);
    }


      return redirect()->back();

  }


  public function update($id,Request $request){

    $input = $request->all();
    $employee = Employee::findOrFail($id);

    if($employee->id == $input['id']){

      $this->validate($request,[
        'fname' => 'required',
        'lname' => 'required'
      ]);

    }else{
      $this->validate($request,[
        'id' => 'required|unique:employees,id',
        'fname' => 'required',
        'lname' => 'required'
      ]);
    }


    $employee->fill($input)->save();

    Session::flash('flash_message','Employee Successfully Updated');

      return redirect()->back();


  }

  public function destroy($id){

    $employee = Employee::findOrFail($id);
    $employee->delete();

    Session::flash('flash_message','Employee Successfully Deleted');
    return redirect('employees');

  }


    public function destroyemployeedepartment($id){

      $employee_department = EmployeeDepartment::findOrFail($id);
      $employee_department->delete();

      Session::flash('flash_message','Department Manager Successfully Deleted');
      return redirect()->back();

    }
    public function destroyemployeesite($id){

      $employee_site = EmployeeSite::findOrFail($id);
      $employee_site->delete();

      Session::flash('flash_message','Employee Site Successfully Deleted');
      return redirect()->back();

    }


}
