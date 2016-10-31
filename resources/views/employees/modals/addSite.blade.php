<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addSiteModal">
Add Site
</button>

<div class="modal fade" id="addSiteModal" tabindex="1" role="dialog" aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close"data-dismiss="modal"aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title" id="favoritesModalLabel">Add Employee Site</h4>
       </div>

      <div class="modal-body">


              {!! Form::open([
                  'route' => ['employees.storesite', $employee->id]

              ]) !!}

              <div class="form-group{{ $errors->has('site_id') ? ' has-error' : '' }}">
                  {!! Form::label('site_id', 'Site') !!}
                  {!! Form::select('site_id', $sites, null, ['class' => 'form-control', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('site_id') }}</small>
              </div>

              <div class="form-group{{ $errors->has('startdate') ? ' has-error' : '' }}">
                  {!! Form::label('startdate', 'Start Date') !!}
                  {!! Form::date('startdate', \Carbon\Carbon::now(), ['class' => 'form-control', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('startdate') }}</small>
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
