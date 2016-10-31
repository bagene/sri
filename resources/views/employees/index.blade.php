@extends('layouts.app')

@section('content')
  <h1> All Employees</h1>

  <div class="col-md-10">


        @if(Session::has('flash_message'))
          <div class="alert alert-success">
            {{Session::get('flash_message')}}
          </div>
        @endif

{{----------------- SEARCH FORM -----------------}}

    <div class="pull-right">
      {!! Form::open(['method'=>'GET','url'=>'employees','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
      <div class="input-group custom-search-form">
          <input type="text" class="form-control" name="search" placeholder="Search...">
          <span class="input-group-btn">
              <button class="btn btn-default-sm" type="submit">
                  <i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
              </button>
          </span>
      </div>
      {!! Form::close() !!}
    </div>


{{----------------- END SEARCH FORM -----------------}}




    <table class='table table-striped table-bordered table-hover table-condensed'>
      <thead>
        <tr>
          <th>Employee ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Site</th>
          <th>Department</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($employees as $employee)
          <tr>
            <td width="100px">{{$employee->id}}</td>
            <td width="150px">{{$employee->fname}}</td>
            <td width="150px">{{$employee->lname}}</td>
            <td width="150px">
              @foreach($employee->employee_sites as $es)
                @if($es['leavedate']==null)
                  <span class="btn btn-xs btn-default">{{$es->site->name}}</span>
                @endif
              @endforeach
            </td>

            <td width="150px">
              @foreach($employee->employee_departments as $ed)
                @if($ed['leavedate']==null)
                  <span class="btn btn-xs btn-default">{{$ed->department->name}}</span>
                @endif
              @endforeach
            </td>

            <td>
              <div class="col-md-3">
                <a class="btn btn-primary" href="{{route('employees.edit',$employee->id)}}">Edit</a>
              </div>
              <div class="col-md-2">
                {!! Form::open(['method' => 'DELETE', 'route' => ['employees.destroy',$employee->id], 'class' => 'form-horizontal']) !!}
                    {!! Form::submit("Delete", ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
              </div>

            </td>
          </tr>
        @endforeach

      </tbody>
    </table>

    {{$employees->render()}}

    <div class="pull-right">
        <a href="employees/create" class="btn btn-default">Create Employee</a>
    </div>

  </div>

@stop
