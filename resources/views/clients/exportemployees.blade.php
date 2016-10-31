@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          <h1>Export Employee</h1>
          {{----------------- Query FORM -----------------}}

              <div class="pull-right">
                {!! Form::open(['method'=>'GET','url'=>'exportemployees','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
                <div class="input-group custom-search-form">
                  <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                      {!! Form::date('date', $date, ['class' => 'form-control', 'required' => 'required']) !!}
                      <small class="text-danger">{{ $errors->first('date') }}</small>
                  </div>
                    <span class="input-group-btn">
                        <button class="btn btn-default-sm" type="submit">
                            <i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
                        </button>
                    </span>
                </div>
                {!! Form::close() !!}
              </div>


          {{----------------- END Query FORM -----------------}}

          <hr><br>

          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Export Employee</h3>
            </div>
            <div class="panel-body">
              <div class='table-responsive'>
                <table class='table table-striped table-bordered table-hover table-condensed'>
                  <thead>
                    <tr>
                      <th>Employee ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Employee Type</th>
                      <th>Start Date</th>
                      <th>Leave Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      @foreach ($employees as $employee)
                        <tr>
                          <td>{{$employee->id}}</td>
                          <td>{{$employee->fname}}</td>
                          <td>{{$employee->lname}}</td>
                          <td>{{$employee->isInternal?'External Employee':'Internal Employee'}}</td>
                          <td>{{$employee->entrydate}}</td>
                          <td>{{$employee->leavedate}}</td>
                        </tr>
                      @endforeach
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <a href="{{route('employees.export')}}" class="btn btn-primary">Export Employees</a>
        </div>
    </div>
</div>
@endsection
