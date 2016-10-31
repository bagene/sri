<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Department;
use App\Employee;
use App\Site;
use Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function querydepartment(){

      $date = \Request::get('date'); //<-- we use global request to get the param of URI
      $departments = Department::all();

      return view('clients.querydepartment',compact('departments','date'));

    }

    public function querysite(){
      $date = \Request::get('date'); //<-- we use global request to get the param of URI
      $sites = Site::all();

      return view('clients.querysite',compact('sites','date'));

    }

    public function exportemployees(){
      $date = \Request::get('date'); //<-- we use global request to get the param of URI
      $employees = Employee::all();

      return view('clients.exportemployees',compact('employees','date'));

    }

    public function export_employees(){
      $employees = Employee::select('id',DB::raw('CONCAT(fname, " ", lname) AS name'),
                            DB::raw('CASE WHEN isInternal=1 THEN "External Employee" ELSE "Internal Employee" END AS EmployeeType'),
                            'entrydate','leavedate')
                              ->get();
      // dd($employees);

      Excel::create('employees', function($excel) use($employees){
        $excel->sheet('Sheet 1', function($sheet) use($employees){
          $sheet->fromArray($employees);
        });
      })->export('xls');
      return redirect()->back();
    }
}
