@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          <h1>Query Site</h1>
          {{----------------- Query FORM -----------------}}

              <div class="pull-right">
                {!! Form::open(['method'=>'GET','url'=>'querysite','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
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

          @foreach($sites as $site)
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">{{$site->name}}</h3>
              </div>
              <div class="panel-body">

                <p>
                  @if($date==null)
                        Current Employees:
                  @else
                        Employees on {{$date}}
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
                      @if($date==null)
                        @foreach($site->site_currentemployees as $de)
                          <tr>
                            <td>{{$de->employee->id}}</td>
                            <td>{{$de->employee->fname}}</td>
                            <td>{{$de->employee->lname}}</td>
                            <td>{{$de->startdate}}</td>
                          </tr>
                        @endforeach
                      @else
                        @foreach($site->site_employee_byDate($date) as $de)
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
                        <tr>

                        @foreach($site->site_historyemployees as $se)
                          <tr>
                            <td>{{$se->employee->id}}</td>
                            <td>{{$se->employee->fname}}</td>
                            <td>{{$se->employee->lname}}</td>
                            <td>{{$se->startdate}}</td>
                            <td>{{$se->leavedate}}</td>
                          </tr>
                        @endforeach

                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>



          @endforeach




        </div>
    </div>
</div>
@endsection
