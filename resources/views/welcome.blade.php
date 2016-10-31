@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

        {{-- Panel Bootstrap http://www.w3schools.com/bootstrap/bootstrap_panels.asp  --}}

        @foreach($categories as $category)
            <div class="panel panel-default">

              <div class="panel-heading">
                <h3 class="panel-title">{{$category->name}}</h3>
              </div>

              <div class="panel-body">
                  @foreach($category->products as $product)

                    <p>

                      @if($product->image!=null)
                          <img height="50px"  width="50px"  class="img-circle" src="data:image;base64,{{ base64_encode($product->image) }}" alt="" />
                      @else
                          <img height="50px"  width="50px"  class="img-circle" src="http://placehold.it/50x50" alt="" />
                      @endif

                      {{$product->name}} - <small>{{$product->description}}</small>
                      <p>
                        P{{$product->price}}
                      </p>

                    </p>
                    <hr>
                  @endforeach
              </div>

            </div>

        @endforeach

        </div>
    </div>
</div>
@endsection
