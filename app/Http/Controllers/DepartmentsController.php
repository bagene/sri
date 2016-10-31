<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Department; // Department Model
use App\Employee;
use App\EmployeeDepartment;
use App\DepartmentManager;
use Session;

class DepartmentsController extends Controller
{
  public function __construct(){
    $this->middleware(['auth','admin']);
  }

  public function index(){

    $search = \Request::get('search'); //<-- we use global request to get the param of URI

    $departments = Department::where('name','like','%'.$search.'%')
        ->orWhere('department_acronym','like','%'.$search.'%')
        ->orderBy('name')
        ->paginate(5);

    return view('departments.index',compact('departments'));
  }

  public function create(){
    $departments = Department::lists('name','id');
    return view('departments.create',compact('departments'));
  }

  public function edit($id){

    $department = Department::findOrFail($id);

    if (isset($department->currentmanager->employee->id)) {

      $employees = Employee::select('id', \DB::raw('CONCAT(fname, " ", lname) AS full_name'))
                                  ->where('id','!=',$department->currentmanager->employee->id)
                                  ->orderBy('fname')
                                  ->lists('full_name', 'id');
    }else {
      $employees = Employee::select('id', \DB::raw('CONCAT(fname, " ", lname) AS full_name'))
                                  ->orderBy('fname')
                                  ->lists('full_name', 'id');
    }

    $departments = Department::lists('name','id');

    return view('departments.edit',compact('departments','department','employees'));

  }

  public function store(Request $request){

    $this->validate($request,[
      'department_acronym' => 'required|unique:departments,department_acronym',
      'name' => 'required'
    ]);

    $input = $request->all();
    Department::create($input);
    Session::flash('flash_message','Department Successfully Created');
    return redirect('departments');

  }

  public function storemanager($id,Request $request){

    $this->validate($request,[
      'employee_id' => 'required',
      'startdate' => 'required'
    ]);

      \DB::transaction(function () use ($id,$request) {

        $input = $request->all();

        $manager = DepartmentManager::where('department_id',$id)
                    ->where('employee_id',$input['employee_id'])
                    ->where('leavedate',null)->first();


        if ($manager==null) {
          //check if the chosen employee is in the department
          $isInDepartment = EmployeeDepartment::where('department_id',$id)
                      ->where('employee_id',$input['employee_id'])
                      ->where('leavedate',null)->first();

          if ($isInDepartment == null) {
            //add the employee to the department before setting it to manager
              $employee['employee_id'] = $input['employee_id'];
              $employee['department_id'] = $id;
              $employee['startdate'] = $input['startdate'];
              EmployeeDepartment::create($employee);
          }


          # save the selected department
          DepartmentManager::create($input);
          Session::flash('flash_message','Employee Manager Successfully Created');
        }else{
          Session::flash('flash_warning','Employee is Already Assigned Manager to that Department');

        }

    });


    return redirect()->back();

  }

  public function changemanager($id,Request $request){

    $this->validate($request,[
      'employee_id' => 'required',
      'startdate' => 'required'
    ]);

      \DB::transaction(function () use ($id,$request) {

        $input = $request->all();

        $currentmanager = DepartmentManager::where('department_id',$id)
                    ->where('employee_id',$input['current_employee_id'])
                    ->where('leavedate',null)->first();

        //update the current managers leavedate
        $update['leavedate'] = $input['startdate'];
        $currentmanager->fill($update)->save();


        $newmanager = DepartmentManager::where('department_id',$id)
                    ->where('employee_id',$input['employee_id'])
                    ->where('leavedate',null)->first();


        //check if the chosen employee is in the department
        $isInDepartment = EmployeeDepartment::where('department_id',$id)
                    ->where('employee_id',$input['employee_id'])
                    ->where('leavedate',null)->first();

        if ($isInDepartment == null) {
          //add the employee to the department before setting it to manager
            $employee['employee_id'] = $input['employee_id'];
            $employee['department_id'] = $id;
            $employee['startdate'] = $input['startdate'];
            EmployeeDepartment::create($employee);
        }


        # save the selected department
        DepartmentManager::create($input);
        Session::flash('flash_message','Employee Manager Successfully Created');


    });


    return redirect()->back();

  }


  public function update($id,Request $request){

    $input = $request->all();
    $department = Department::findOrFail($id);

    if($department->department_acronym == $input['department_acronym']){

      $this->validate($request,[
        'name' => 'required',
        'department_acronym' => 'required'
      ]);

    }else{
      $this->validate($request,[
        'department_acronym' => 'required|unique:deparatments,department_acronym',
        'name' => 'required'
      ]);
    }

    $department->fill($input)->save();
    Session::flash('flash_message','Department Successfully Updated');
    return redirect('departments');

  }

  public function destroymanager($id){

    $manager = DepartmentManager::findOrFail($id);
    $manager->delete();

    Session::flash('flash_message','Employee Department Successfully Deleted');
    return redirect()->back();

  }


  public function destroy($id){

    $department = Department::findOrFail($id);
    $department->delete();

    Session::flash('flash_message','Department Successfully Deleted');
    return redirect('departments');

  }
}
