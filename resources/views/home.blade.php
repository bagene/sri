@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                       <div class="row">
                         <div class="col-md-4">
                           <div class="well" style="background-color:#D4EDF4">
                                 <h2>Departments</h2>
                                 <p></p>
                                   <p><a class="btn btn-default" href="{{ url('/querydepartment') }}"role="button">Select &raquo;</a></p>
                             </div>
                         </div>
                         <div class="col-md-4">
                           <div class="well" style="background-color:#F9FBBA">
                                 <h2>Sites</h2>
                                 <p></p>
                                   <p><a class="btn btn-default"  href="{{ url('/querysite') }}" role="button">Select &raquo;</a></p>
                             </div>
                        </div>
                         <div class="col-md-4">
                           <div class="well" style="background-color:#C3D7DF">
                                 <h2>Export Employee</h2>
                                 <p></p>
                                     <p><a class="btn btn-default"  href="{{ url('/exportemployees') }}" role="button">Export &raquo;</a></p>
                             </div>
                         </div>
                       </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
