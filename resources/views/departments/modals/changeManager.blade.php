<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#changeManagerModal">
Change
</button>


<div class="modal fade" id="changeManagerModal" tabindex="1" role="dialog" aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close"data-dismiss="modal"aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title" id="favoritesModalLabel">Change Department Manager</h4>
       </div>

      <div class="modal-body">


              {!! Form::open([
                  'route' => ['departments.changemanager', $department->id]

              ]) !!}
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Current Manager Info</h3>
                </div>
                <div class="panel-body">
                  {!! Form::hidden('current_employee_id', $department->currentmanager->employee->id) !!}
                  <div class="form-group{{ $errors->has('currentemployee') ? ' has-error' : '' }}">
                      {!! Form::label('currentemployee', 'Name') !!}
                      {!! Form::text('currentemployee',  $department->currentmanager->employee->fname . " " . $department->currentmanager->employee->lname, ['class' => 'form-control', 'required' => 'required','readonly']) !!}
                      <small class="text-danger">{{ $errors->first('currentemployee') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('current_start date') ? ' has-error' : '' }}">
                      {!! Form::label('current_leavedate', 'Date') !!}
                      {!! Form::text('current_leavedate', $department->currentmanager->startdate, ['class' => 'form-control', 'required' => 'required','readonly']) !!}
                      <small class="text-danger">{{ $errors->first('current_leavedate') }}</small>
                  </div>
                </div>
              </div>

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">New Manager</h3>
                </div>
                <div class="panel-body">

                  <div class="form-group{{ $errors->has('employee_id') ? ' has-error' : '' }}">
                      {!! Form::label('employee_id', 'Employee') !!}
                      {!! Form::select('employee_id', $employees ,null, ['class' => 'form-control', 'required' => 'required']) !!}
                      <small class="text-danger">{{ $errors->first('employee_id') }}</small>
                  </div>

                  <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                      {!! Form::label('department', 'Department') !!}
                      {!! Form::text('department', $department->name , ['class' => 'form-control', 'required' => 'required','readonly']) !!}
                      <small class="text-danger">{{ $errors->first('department') }}</small>
                  </div>

                  {!! Form::hidden('department_id', $department->id) !!}

                  <div class="form-group{{ $errors->has('startdate') ? ' has-error' : '' }}">
                      {!! Form::label('startdate', 'Start Date') !!}
                      {!! Form::date('startdate', \Carbon\Carbon::now(), ['class' => 'form-control', 'required' => 'required']) !!}
                      <small class="text-danger">{{ $errors->first('startdate') }}</small>
                  </div>
                </div>
              </div>




      </div>

      <div class="modal-footer">
        {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}


        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  </div>
</div>
</div>
