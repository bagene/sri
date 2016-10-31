@extends('layouts.app')

@section('content')
  <h1> All Departments</h1>

  <div class="col-md-10">


        @if(Session::has('flash_message'))
          <div class="alert alert-success">
            {{Session::get('flash_message')}}
          </div>
        @endif

{{----------------- SEARCH FORM -----------------}}

    <div class="pull-right">
      {!! Form::open(['method'=>'GET','url'=>'departments','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
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
          <th>Department Acronym</th>
          <th>Name</th>
          <th>Parent Department</th>
          <th>Child Department</th>
          <th>Manager</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($departments as $department)
          <tr>
            <td width="100px">{{$department->department_acronym}}</td>
            <td width="150px">{{$department->name}}</td>
            <td width="150px">{{$department->parent['name']}}</td>
            <td width="150px">
              @foreach($department->children as $c)
                <span class= "btn btn-xs btn-default">{{$c->name}}</span>
              @endforeach
            </td>
            <td width="150px">
                @if(isset($department->currentmanager->employee->id))
                  {{$department->currentmanager->employee->fname . ' ' . $department->currentmanager->employee->lname}}
                @endif
            </td>

            <td>
              <div class="col-md-3">
                <a class="btn btn-primary" href="{{route('departments.edit',$department->id)}}">Edit</a>
              </div>
              <div class="col-md-2">
                @if($department->parent_id == 0)
                  {{-- cant delete the root department --}}
                @else
                  {!! Form::open(['method' => 'DELETE', 'route' => ['departments.destroy',$department->id], 'class' => 'form-horizontal']) !!}
                      {!! Form::submit("Delete", ['class' => 'btn btn-danger']) !!}
                  {!! Form::close() !!}
                @endif

              </div>

            </td>
          </tr>
        @endforeach

      </tbody>
    </table>

    {{$departments->render()}}

    <div class="pull-right">
        <a href="departments/create" class="btn btn-default">Create Department</a>
    </div>

  </div>

@stop
