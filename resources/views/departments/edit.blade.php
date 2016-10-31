@extends('layouts.app')

@section('content')
  <h1>Edit Department <a class="btn-sm btn-primary" href="/departments"> Back to all departments</a></h1><hr>
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
  <div class="container">
      <div class="row">
      	<div class="col-md-12">
              <div class="panel with-nav-tabs panel-default">
                  <div class="panel-heading">
                          <ul class="nav nav-tabs">
                              <li class="active"><a href="#tab1default" data-toggle="tab">Department Info</a></li>
                              <li><a href="#tab2default" data-toggle="tab">Employee</a></li>
                              <li><a href="#tab3default" data-toggle="tab">Manager</a></li>

                          </ul>
                  </div>
                  <div class="panel-body">
                      <div class="tab-content">
                          <div class="tab-pane fade in active" id="tab1default">
                            {!! Form::model($department, ['route' => ['departments.update', $department->id], 'method' => 'PUT']) !!}

                              <div class="col-md-8">
                                <div class="form-group{{ $errors->has('department_acronym') ? ' has-error' : '' }}">
                                    {!! Form::label('department_acronym', 'Department Acronym') !!}
                                    {!! Form::text('department_acronym', null, ['class' => 'form-control']) !!}
                                    <small class="text-danger">{{ $errors->first('department_acronym') }}</small>
                                </div>

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    {!! Form::label('name', 'Department Name') !!}
                                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                </div>

                                @if($department->parent_id == 0)
                                  <div class="alert alert-danger">  This is the root department no need to choose Parent Department</div>
                                  <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                                      {!! Form::label('parent_id', 'Parent Department') !!}
                                      {!! Form::select('parent_id', array() , null, ['class' => 'form-control']) !!}
                                      <small class="text-danger">{{ $errors->first('parent_id') }}</small>
                                  </div>
                                @else
                                  <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                                      {!! Form::label('parent_id', 'Parent Department') !!}
                                      {!! Form::select('parent_id', $departments , null, ['class' => 'form-control']) !!}
                                      <small class="text-danger">{{ $errors->first('parent_id') }}</small>
                                  </div>
                                @endif



                                <br>
                                <div class="pull-right">
                                  {!! Form::submit("Update", ['class' => 'btn btn-success']) !!}
                                </div>

                              </div>

                            {!! Form::close() !!}

                          </div>
                          <div class="tab-pane fade" id="tab2default">
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h3 class="panel-title">Current Employees</h3>
                              </div>
                              <div class="panel-body">
                                <div class='table-responsive'>
                                  <table class='table table-striped table-bordered table-hover table-condensed'>
                                    <thead>
                                      <tr>
                                        <th>Employee ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                      </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($department->department_currentemployees as $de)
                                      <tr>
                                        <td>{{$de->employee->id}}</td>
                                        <td>{{$de->employee->fname}}</td>
                                        <td>{{$de->employee->lname}}</td>
                                      </tr>
                                    @endforeach

                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>

                            <div class="panel panel-danger">
                              <div class="panel-heading">
                                <h3 class="panel-title">History</h3>
                              </div>
                              <div class="panel-body">
                                <div class='table-responsive'>
                                  <table class='table table-striped table-bordered table-hover table-condensed'>
                                    <thead>
                                      <tr>
                                        <th>Employee ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Start Date</th>
                                        <th>Leave Date</th>

                                      </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($department->department_historyemployees as $de)
                                      <tr>
                                        <td>{{$de->employee->id}}</td>
                                        <td>{{$de->employee->fname}}</td>
                                        <td>{{$de->employee->lname}}</td>
                                        <td>{{$de->startdate}}</td>
                                        <td>{{$de->leavedate}}</td>
                                      </tr>
                                    @endforeach

                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>

                          </div>

                          <div class="tab-pane fade" id="tab3default">
                              <div class="panel panel-default">
                                <div class="panel-heading">
                                  <h3 class="panel-title">Current Manager</h3>
                                </div>
                                <div class="panel-body">
                                  <div class='table-responsive'>
                                    <table class='table table-striped table-bordered table-hover table-condensed'>
                                      <thead>
                                        <tr>
                                          <th>Employee ID</th>
                                          <th>First Name</th>
                                          <th>Last Name</th>
                                          <th>Start Date</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          @if(isset($department->currentmanager->employee->id))
                                            <td>{{$department->currentmanager->employee->id}}</td>
                                            <td>{{$department->currentmanager->employee->fname}}</td>
                                            <td>{{$department->currentmanager->employee->lname}}</td>
                                            <td>{{$department->currentmanager->startdate}}</td>
                                            <td>

                                              <div class="col-md-2">
                                                @include('departments.modals.changeManager')
                                              </div>
                                              <div class="col-md-2">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['departments.destroymanager',$department->currentmanager->id], 'class' => 'form-horizontal']) !!}

                                                        {!! Form::submit("Delete", ['class' => 'btn btn-xs btn-danger','onsubmit' => 'return ConfirmLeave()']) !!}
                                                {!! Form::close() !!}
                                              </div>
                                            </td>
                                          @endif


                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                  @if(!isset($department->currentmanager->employee->id))
                                    <div class="pull-right">
                                      @include('departments.modals.addManager')
                                    </div>
                                  @endif

                                </div>
                              </div>

                              <div class="panel panel-danger">
                                <div class="panel-heading">
                                  <h3 class="panel-title">History</h3>
                                </div>
                                <div class="panel-body">
                                  <div class='table-responsive'>
                                    <table class='table table-striped table-bordered table-hover table-condensed'>
                                      <thead>
                                        <tr>
                                          <th>Employee ID</th>
                                          <th>First Name</th>
                                          <th>Last Name</th>
                                          <th>Start Date</th>
                                          <th>End Date</th>

                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($department->department_historymanagers as $dm)
                                          <tr>
                                            <td>{{$dm->employee->id}}</td>
                                            <td>{{$dm->employee->fname}}</td>
                                            <td>{{$dm->employee->lname}}</td>
                                            <td>{{$dm->startdate}}</td>
                                            <td>{{$dm->leavedate}}</td>
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


@stop
