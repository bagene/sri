@extends('layouts.app')

@section('content')
  <h1> All Site</h1>

  <div class="col-md-10">


        @if(Session::has('flash_message'))
          <div class="alert alert-success">
            {{Session::get('flash_message')}}
          </div>
        @endif

{{----------------- SEARCH FORM -----------------}}

    <div class="pull-right">
      {!! Form::open(['method'=>'GET','url'=>'sites','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
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
          <th width="280">Name</th>
          <th width="400">Address</th>
          <th>Type</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($sites as $site)
          <tr>
            <td>{{$site->name}}</td>
            <td>{{$site->address}}</td>
            <td>
              @if($site->isInternal == 0)
                  Internal
              @else
                  External
              @endif
            </td>
            <td>
              <div class="col-md-4">
                <a class="btn btn-primary" href="{{route('sites.edit',$site->id)}}">Edit</a>
              </div>
              <div class="col-md-3">
                {!! Form::open(['method' => 'DELETE', 'route' => ['sites.destroy',$site->id], 'class' => 'form-horizontal']) !!}
                    {!! Form::submit("Delete", ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
              </div>

            </td>
          </tr>
        @endforeach

      </tbody>
    </table>

    {{$sites->render()}}

    <div class="pull-right">
        <a href="sites/create" class="btn btn-default">Create Site</a>
    </div>

  </div>





@stop
