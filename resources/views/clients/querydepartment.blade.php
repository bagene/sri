@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          <h1>Query Department</h1>
          {{----------------- Query FORM -----------------}}

              <div class="pull-right">
                {!! Form::open(['method'=>'GET','url'=>'querydepartment','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
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
          @foreach($departments as $department)
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">{{$department->name}}</h3>
              </div>
              <div class="panel-body">
                @if($date == null)
                  Current Manager :@if(isset($department->currentmanager->employee->id))
                                      {{$department->currentmanager->employee->fname . ' ' . $department->currentmanager->employee->lname}}
                                   @endif
                @else
                    Manager on {{$date}}:@if(isset($department->currentmanager_bydate($date)->employee->id))
                                        {{$department->currentmanager_bydate($date)->employee->fname . ' ' . $department->currentmanager->employee->lname}}
                                     @endif
                @endif


                <p>
                  @if($date == null)
                        Current Employees:
                  @else
                        Employees on {{$date}}:
                  @endif

                </p>

                <div class='table-responsive'>
                  <table class='table table-striped table-bordered table-hover table-condensed'>
                    <thead>
                      <tr>
                        <th>Employee ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Start Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      @if($date == null)
                        @foreach($department->department_currentemployees as $de)
                          <tr>
                            <td>{{$de->employee->id}}</td>
                            <td>{{$de->employee->fname}}</td>
                            <td>{{$de->employee->lname}}</td>
                            <td>{{$de->startdate}}</td>
                          </tr>
                        @endforeach

                      @else
                        @foreach($department->department_employees_bydate($date) as $de)
                          <tr>
                            <td>{{$de->employee->id}}</td>
                            <td>{{$de->employee->fname}}</td>
                            <td>{{$de->employee->lname}}</td>
                            <td>{{$de->startdate}}</td>
                          </tr>
                        @endforeach

                      @endif


                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>

          @endforeach

        </div>
    </div>
</div>
@endsection
