@extends('layouts.app')

@section('content')
  <h1> Create Department <a class="btn-sm btn-primary" href="/departments"> Back to all departments</a></h1>

{!! Form::open(['method' => 'POST', 'route' => 'departments.store', 'class' => 'form-horizontal']) !!}

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

          <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
              {!! Form::label('parent_id', 'Parent Department') !!}
              {!! Form::select('parent_id', $departments , null, ['class' => 'form-control']) !!}
              <small class="text-danger">{{ $errors->first('parent_id') }}</small>
          </div>

          <br>

          <div class="pull-right">
            {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!}
            {!! Form::submit("Add", ['class' => 'btn btn-success']) !!}
          </div>

        </div>

{!! Form::close() !!}
@stop
