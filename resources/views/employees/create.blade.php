@extends('layouts.app')

@section('content')
  <h1> Create Employee <a class="btn-sm btn-primary" href="/employees"> Back to all employees</a></h1><hr>

{!! Form::open(['method' => 'POST', 'route' => 'employees.store', 'class' => 'form-horizontal']) !!}

        <div class="col-md-12">

          {{---------------------- EMPLOYEE INFO PANEL ----------------------}}

          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Employee Info</h3>
            </div>
            <div class="panel-body">
              <div class="col-md-10">
                <div class="col-md-4">
                  <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                      {!! Form::label('id', 'Employee ID') !!}
                      {!! Form::text('id', null, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('id') }}</small>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group{{ $errors->has('ss_number') ? ' has-error' : '' }}">
                      {!! Form::label('ss_number', 'SS-Number') !!}
                      {!! Form::text('ss_number', null, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('ss_number') }}</small>
                  </div>

                </div>

                <div class="col-md-4">
                  <div class="form-group{{ $errors->has('entrydate') ? ' has-error' : '' }}">
                      {!! Form::label('entrydate', 'Entry Date') !!}
                      {!! Form::date('entrydate', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('entrydate') }}</small>
                  </div>

                </div>

              </div>

              <div class="col-md-10">
                <div class="col-md-6">
                  <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                      {!! Form::label('fname', 'First Name') !!}
                      {!! Form::text('fname', null, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('fname') }}</small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                      {!! Form::label('lname', 'Last Name') !!}
                      {!! Form::text('lname', null, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('lname') }}</small>
                  </div>

                </div>
              </div>


              <div class="col-md-10">
                <div class="col-md-4">
                  <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                      {!! Form::label('gender', 'Gender') !!}
                      {!! Form::select('gender',array("M"=>"Male","F"=>"Female"), "M", ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('gender') }}</small>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
                      {!! Form::label('birthdate', 'Birthdate') !!}
                      {!! Form::date('birthdate', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('birthdate') }}</small>
                  </div>

                </div>

                <div class="col-md-4">
                  <div class="form-group{{ $errors->has('isInternal') ? ' has-error' : '' }}">
                      {!! Form::label('isInternal', 'Employee Type') !!}
                    {!! Form::select('isInternal',array("0"=>"Internal Employee","1"=>"External Employee"), null, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('isInternal') }}</small>
                  </div>

                </div>

              </div>

            </div>
          </div>

              {{---------------------- END EMPLOYEE INFO PANEL ----------------------}}



          {{---------------------- ADDRESS INFO PANEL ----------------------}}

          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Employee Address</h3>
            </div>
            <div class="panel-body">
              <div class="col-md-10">
                <div class="col-md-4">
                  <div class="form-group{{ $errors->has('housenumber') ? ' has-error' : '' }}">
                      {!! Form::label('housenumber', 'House #') !!}
                      {!! Form::text('housenumber', null, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('housenumber') }}</small>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                      {!! Form::label('street', 'Street') !!}
                      {!! Form::text('street', null, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('ss_nustreetmber') }}</small>
                  </div>

                </div>
              </div>

              <div class="col-md-10">
                <div class="col-md-8">
                  <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                      {!! Form::label('city', 'City') !!}
                      {!! Form::text('city', null, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('city') }}</small>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group{{ $errors->has('postalcode') ? ' has-error' : '' }}">
                      {!! Form::label('postalcode', 'Postal Code') !!}
                      {!! Form::number('postalcode', null, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('postalcode') }}</small>
                  </div>

                </div>
              </div>

            </div>
          </div>

              {{---------------------- END ADDRESS PANEL ----------------------}}


          {{---------------------- CONTACT INFO PANEL ----------------------}}

          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Contact Info</h3>
            </div>
            <div class="panel-body">
              <div class="col-md-10">
                <div class="col-md-6">
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      {!! Form::label('email', 'Personal Email') !!}
                      {!! Form::email('email', null, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('email') }}</small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group{{ $errors->has('telephonenumber') ? ' has-error' : '' }}">
                      {!! Form::label('telephonenumber', 'Personal Tel. No.') !!}
                      {!! Form::text('telephonenumber', null, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('telephonenumber') }}</small>
                  </div>

                </div>
              </div>

              <div class="col-md-10">
                <div class="col-md-8">
                  <div class="form-group{{ $errors->has('faxnumber') ? ' has-error' : '' }}">
                      {!! Form::label('faxnumber', 'Personal Fax Number') !!}
                      {!! Form::text('faxnumber', null, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('faxnumber') }}</small>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group{{ $errors->has('mobilenumber') ? ' has-error' : '' }}">
                      {!! Form::label('mobilenumber', 'Personal Mobile Number') !!}
                      {!! Form::number('mobilenumber', null, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('mobilenumber') }}</small>
                  </div>

                </div>
              </div>

            </div>
          </div>

              {{---------------------- END CONTACT INFO PANEL ----------------------}}


          {{---------------------- BUSINESS CONTACT INFO PANEL ----------------------}}

          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Business Contact Info</h3>
            </div>
            <div class="panel-body">
              <div class="col-md-10">
                <div class="col-md-4">
                  <div class="form-group{{ $errors->has('business_email') ? ' has-error' : '' }}">
                      {!! Form::label('business_email', 'Personal Email') !!}
                      {!! Form::email('business_email', null, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('business_email') }}</small>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group{{ $errors->has('business_phonenumber') ? ' has-error' : '' }}">
                      {!! Form::label('business_phonenumber', 'Business Phone No.') !!}
                      {!! Form::text('business_phonenumber', null, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('business_phonenumber') }}</small>
                  </div>

                </div>

                <div class="col-md-4">
                  <div class="form-group{{ $errors->has('business_faxnumber') ? ' has-error' : '' }}">
                      {!! Form::label('business_faxnumber', 'Business Fax No.') !!}
                      {!! Form::text('business_faxnumber', null, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('business_faxnumber') }}</small>
                  </div>

                </div>


              </div>

            </div>
          </div>

              {{---------------------- END BUSINESS CONTACT INFO PANEL ----------------------}}

          <br>

          <div class="pull-right">
            {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!}
            {!! Form::submit("Add", ['class' => 'btn btn-success']) !!}

            <br><br><br>
          </div>

        </div>



{!! Form::close() !!}
@stop
