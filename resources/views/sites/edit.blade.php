@extends('layouts.app')

@section('content')
  <h1>Edit Sites <a class="btn-sm btn-primary" href="/sites"> Back to all sites</a></h1><hr>

    <div class="container">
        <div class="row">
        	<div class="col-md-12">
                <div class="panel with-nav-tabs panel-default">
                    <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1default" data-toggle="tab">Site Info</a></li>
                                <li><a href="#tab2default" data-toggle="tab">Employee</a></li>

                            </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab1default">
                              {!! Form::model($site, ['route' => ['sites.update', $site->id], 'method' => 'PUT']) !!}

                              <div class="col-md-8">
                                <div class="row">
                                  <div class="col-md-8">
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        {!! Form::label('name', 'Site Name') !!}
                                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                        <small class="text-danger">{{ $errors->first('name') }}</small>
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('isInternal') ? ' has-error' : '' }}">
                                        {!! Form::label('isInternal', 'Site Type') !!}
                                        {!! Form::select('isInternal', array('0'=>'Internal','1'=>'External'), null,['class' => 'form-control', 'required' => 'required']) !!}
                                        <small class="text-danger">{{ $errors->first('isInternal') }}</small>
                                    </div>
                                  </div>
                                </div>


                                  <div id='map' style="width:100%; height:400px;"></div>
                                  <input id="pac-input" class="controls" type="text" placeholder="Search Box" onkeydown="if (event.keyCode == 13) return false">
                                  <hr>

                                  <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                      {!! Form::label('address', 'Site Address') !!}
                                      {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
                                      <small class="text-danger">{{ $errors->first('address') }}</small>
                                  </div>


                                  <div class="form-group{{ $errors->has('longtitude') ? ' has-error' : '' }}">
                                      {!! Form::label('longtitude', 'Site longtitude') !!}
                                      {!! Form::text('longtitude', null, ['class' => 'form-control','id'=>'lon','readonly']) !!}
                                      <small class="text-danger">{{ $errors->first('longtitude') }}</small>
                                  </div>


                                  <div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
                                      {!! Form::label('latitude', 'Site latitude') !!}
                                      {!! Form::text('latitude', null, ['class' => 'form-control','id'=>'lat','readonly']) !!}
                                      <small class="text-danger">{{ $errors->first('latitude') }}</small>
                                  </div>

                                  <br>
                                  <div class="pull-right">
                                    {!! Form::submit("Update", ['class' => 'btn btn-success']) !!}
                                      <br><br>
                                  </div>

                                </div>

                              {!! Form::close() !!}

                            </div>
                            <div class="tab-pane fade" id="tab2default">
                              <div class="panel panel-default">
                                <div class="panel-heading">
                                  <h3 class="panel-title">Current Employees</h3>
                                </div>
                                <div class="panel-body">
                                  <div class='table-responsive'>
                                    <table class='table table-striped table-bordered table-hover table-condensed'>
                                      <thead>
                                        <tr>
                                          <th>Employee ID</th>
                                          <th>First Name</th>
                                          <th>Last Name</th>
                                        </tr>
                                      </thead>
                                      <tbody>

                                      @foreach($site->site_currentemployees as $se)
                                        <tr>
                                          <td>{{$se->employee->id}}</td>
                                          <td>{{$se->employee->fname}}</td>
                                          <td>{{$se->employee->lname}}</td>
                                        </tr>
                                      @endforeach

                                      </tbody>
                                    </table>
                                  </div>
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

                                      @foreach($site->site_historyemployees as $se)
                                        <tr>
                                          <td>{{$se->employee->id}}</td>
                                          <td>{{$se->employee->fname}}</td>
                                          <td>{{$se->employee->lname}}</td>
                                          <td>{{$se->startdate}}</td>
                                          <td>{{$se->leavedate}}</td>
                                        </tr>
                                      @endforeach

                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

    	</div>
    </div>





  <!--googlemap-->


 <!-- Replace the value of the key parameter with your own API key. -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaSXouxDpCu6AAgYgs0u0GGUjutNVqOGE&libraries=places&callback=initAutocomplete" async defer></script>

 <script>

// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
window.initAutocomplete = function(){

 var  lon = {{$site->longtitude}};
 var lat = {{$site->latitude}};

 var map = new google.maps.Map(document.getElementById('map'), {
   center: {lat:  lat, lng: lon},
   zoom: 15,
   mapTypeId: 'roadmap'
 });


 var longitude = document.getElementById('lon'); //link the longtitude inputbox with an id of #lon
 var latitude = document.getElementById('lat'); //link the longtitude inputbox with an id of #lat


 // Create the search box and link it to the UI element.
 var input = document.getElementById('pac-input');
 var searchBox = new google.maps.places.SearchBox(input);


 map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

 // Bias the SearchBox results towards current map's viewport.
 map.addListener('bounds_changed', function() {
   searchBox.setBounds(map.getBounds());
 });




 var marker;

 var myLatLng ={lat:  lat, lng: lon }; //the default will be saved case coordinates in db
  // Create a marker for each place.
     marker = new google.maps.Marker({
       position: myLatLng,
         map: map,
         draggable: true,
         title: 'Hello World!'
     });

    //set the value of lon lat in the User Interface
   latitude.value = {{$site->latitude}};
   longitude.value = {{$site->longtitude}};

 // Listen for the event fired when the user selects a prediction and retrieve
 // more details for that place.
 searchBox.addListener('places_changed', function() {
   var places = searchBox.getPlaces();



   if (places.length == 0) {

    alert("zero result");

    // Clear out the old markers.
    marker.setMap(null);


  // Create a marker for each place.
     marker = new google.maps.Marker({
         position: myLatLng,
         map: map,
         draggable: true,
         title: 'Hello World!'
     });
      latitude.value = "";
      longitude.value =  "";
      map.setCenter(myLatLng);
      map.setZoom(15);

   }else{
        // Clear out the old markers.

     marker.setMap(null);

   markers = [];

   // For each place, get the icon, name and location.
   var bounds = new google.maps.LatLngBounds();


   places.every(function(place) {
     if (!place.geometry) {
       console.log("Returned place contains no geometry");
       return;
     }
     var icon = {

       size: new google.maps.Size(71, 71),
       origin: new google.maps.Point(0, 0),
       anchor: new google.maps.Point(17, 34),
       scaledSize: new google.maps.Size(25, 25)
     };

     // Create a marker for each place.
     marker= new google.maps.Marker({
       map: map,
       draggable:true,
       icon: icon,
       title: place.name,
       position: place.geometry.location
     });



     if (place.geometry.viewport) {
       // Only geocodes have viewport.
       bounds.union(place.geometry.viewport);
     } else {
       bounds.extend(place.geometry.location);
     }

   map.setCenter(place.geometry.location);


     latitude.value = place.geometry.location.lat();
    longitude.value =  place.geometry.location.lng();
   return false;
   });
   map.setZoom(15);



   }



   google.maps.event.addListener(marker, 'dragend', function(evt){
        console.log(evt.latLng.lat());
        document.getElementById('lat').value = evt.latLng.lat();
        document.getElementById('lon').value  = evt.latLng.lng();
   });

 });



google.maps.event.addListener(marker, 'dragend', function(evt){
    console.log(evt.latLng.lat());
    document.getElementById('lat').value = evt.latLng.lat();
     document.getElementById('lon').value  = evt.latLng.lng();
});


document.getElementById("pac-input").addEventListener("keydown", function(e) {

   // Enter is pressed
   if (e.keyCode == 13) {


       document.getElementById('address').value = document.getElementById('pac-input').value;

   }
}, false);



}




 </script>
@stop
