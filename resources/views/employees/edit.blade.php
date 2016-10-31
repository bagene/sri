@extends('layouts.app')

@section('content')
  <h1>Edit Employee <a class="btn-sm btn-primary" href="/employees"> Back to all employees</a></h1><hr>


  <div class="container">
    <div class="row">
    	<div class="col-md-12">

        @if(Session::has('flash_message'))
          <div class="alert alert-success">
            {{Session::get('flash_message')}}
          </div>
        @endif

        @if(Session::has('flash_warning'))
          <div class="alert alert-danger">
            {{Session::get('flash_warning')}}
          </div>
        @endif

            <div class="panel with-nav-tabs panel-info">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Employee</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Employment</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">

                          @include('employees.includes.editemployee')
                        </div>
                        <div class="tab-pane fade" id="tab2default">

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">Site</h3>

                            </div>
                            <div class="panel-body">

                              <div class='table-responsive'>
                                <table class='table table-striped table-bordered table-hover table-condensed'>
                                  <thead>
                                    <tr>
                                      <th width="600px">Site</th>
                                      <th width="200px">Start Date</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($employee->employee_sites->where('leavedate',null) as $es)
                                      <tr>
                                        <td>{{$es->site->name}}</td>
                                        <td>{{$es->startdate}}</td>
                                        <td>
                                          <div class="col-md-2">
                                            {!! Form::open(['method' => 'PUT', 'route' => ['employees.leave_employeesite',$es->id], 'class' => 'form-horizontal']) !!}

                                                    {!! Form::submit("Leave", ['class' => 'btn btn-xs btn-success','onsubmit' => 'return ConfirmLeave()']) !!}
                                            {!! Form::close() !!}
                                          </div>
                                          <div class="col-md-2">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['employees.destroy_employeesite',$es->id], 'class' => 'form-horizontal']) !!}

                                                    {!! Form::submit("Delete", ['class' => 'btn btn-xs btn-danger','onsubmit' => 'return ConfirmLeave()']) !!}
                                            {!! Form::close() !!}
                                          </div>
                                        </td>
                                      </tr>
                                    @endforeach

                                  </tbody>
                                </table>
                              </div>

                              <div class="pull-right">
                                  @include('employees.modals.addSite')
                              </div>

                              <hr>
                              <div class="panel panel-danger">
                                <div class="panel-heading">
                                  <h3 class="panel-title">History</h3>
                                </div>
                                <div class="panel-body">
                                  <div class='table-responsive'>
                                    <table class='table table-striped table-bordered table-hover table-condensed'>
                                      <thead>
                                        <tr>
                                          <th width="500px">Site</th>
                                          <th width="200px">Start Date</th>
                                          <th width="200px">Leave Date</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($employee->employee_sites as $es)
                                          <tr>
                                            @if($es['leavedate'] != null)
                                              <td>{{$es->site->name}}</td>
                                              <td>{{$es->startdate}}</td>
                                              <td>{{$es->leavedate}}</td>
                                              <td>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['employees.destroy_employeesite',$es->id], 'class' => 'form-horizontal']) !!}

                                                        {!! Form::submit("Delete", ['class' => 'btn btn-xs btn-danger','onsubmit' => 'return ConfirmLeave()']) !!}
                                                {!! Form::close() !!}
                                              </td>
                                            @endif

                                          </tr>
                                        @endforeach

                                      </tbody>
                                    </table>
                                  </div>

                                </div>
                              </div>
                            </div>



                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">Department</h3>
                            </div>
                            <div class="panel-body">
                              <div class='table-responsive'>
                                <table class='table table-striped table-bordered table-hover table-condensed'>
                                  <thead>
                                    <tr>
                                      <th width="600px">Department</th>
                                      <th width="200px">Start Date</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($employee->employee_departments->where('leavedate',null) as $ed)
                                      <tr>
                                        <td>{{$ed->department->name}}
                                          @if(isset($ed->department->currentmanager->employee->id))
                                            @if($ed->department->currentmanager->employee->id == $employee->id )
                                              <span class="btn btn-xs btn-warning">Manager</span>
                                            @endif
                                          @endif

                                        </td>
                                        <td>{{$ed->startdate}}</td>
                                        <td>

                                          @if(isset($ed->department->currentmanager->employee->id))
                                            @if($ed->department->currentmanager->employee->id == $employee->id )
                                            
                                            @else
                                              <div class="col-md-2">
                                                {!! Form::open(['method' => 'PUT', 'route' => ['employees.leave_employeedepartment',$ed->id], 'class' => 'form-horizontal']) !!}
                                                        {!! Form::submit("Leave", ['class' => 'btn btn-xs btn-success']) !!}
                                                {!! Form::close() !!}
                                              </div>
                                              <div class="col-md-2">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['employees.destroy_employeedepartment',$ed->id], 'class' => 'form-horizontal']) !!}
                                                        {!! Form::submit("Delete", ['class' => 'btn btn-xs btn-danger']) !!}
                                                {!! Form::close() !!}
                                              </div>
                                            @endif
                                          @else
                                            <div class="col-md-2">
                                              {!! Form::open(['method' => 'PUT', 'route' => ['employees.leave_employeedepartment',$ed->id], 'class' => 'form-horizontal']) !!}
                                                      {!! Form::submit("Leave", ['class' => 'btn btn-xs btn-success']) !!}
                                              {!! Form::close() !!}
                                            </div>
                                            <div class="col-md-2">
                                              {!! Form::open(['method' => 'DELETE', 'route' => ['employees.destroy_employeedepartment',$ed->id], 'class' => 'form-horizontal']) !!}
                                                      {!! Form::submit("Delete", ['class' => 'btn btn-xs btn-danger']) !!}
                                              {!! Form::close() !!}
                                            </div>
                                          @endif




                                        </td>

                                      </tr>
                                    @endforeach

                                  </tbody>
                                </table>
                              </div>
                              <div class="pull-right">
                                  @include('employees.modals.addDepartment')
                              </div>

                              <hr>
                              <div class="panel panel-danger">
                                <div class="panel-heading">
                                  <h3 class="panel-title">History</h3>
                                </div>
                                <div class="panel-body">
                                  <div class='table-responsive'>
                                    <table class='table table-striped table-bordered table-hover table-condensed'>
                                      <thead>
                                        <tr>
                                          <th width="500px">Department</th>
                                          <th width="200px">Start Date</th>
                                          <th width="200px">Leave Date</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($employee->employee_departments as $ed)
                                          <tr>
                                            @if($ed['leavedate'] != null)
                                              <td>{{$ed->department->name}}</td>
                                              <td>{{$ed->startdate}}</td>
                                              <td>{{$ed->leavedate}}</td>
                                              <td>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['employees.destroy_employeedepartment',$ed->id], 'class' => 'form-horizontal']) !!}
                                                        {!! Form::submit("Delete", ['class' => 'btn btn-xs btn-danger']) !!}
                                                {!! Form::close() !!}
                                              </td>
                                            @endif

                                          </tr>
                                        @endforeach

                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>

                            </div>

                          </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

	</div>
</div>


<script>

  function ConfirmLeave()
  {
  var x = confirm("Are you sure you want to leave?");
  if (x)
    return true;
  else
    return false;
  }

</script>

@stop
