@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    @foreach($products as $product)
    <div class="col-12 col-sm-8 col-md-6 col-lg-4">
      <div class="card">
        <img class="card-img" src="{{ URL::asset('public/images/'.$product->thumbnail) }}" alt="{{ $product->name }}">

        <div class="card-body">
          <h4 class="card-title">{{ $product->name }}</h4>
          <h6 class="card-subtitle mb-2 text-muted">{{ $product->name }}</h6>
          <p class="card-text">{{ $product->description }}</p>
          <div class="buy d-flex justify-content-between align-items-center">
            <div class="price text-success"><h5 class="mt-4">{{ $product->price }}</h5></div>
            @if($product->quantity >=1 ) 
              <a href="home/product_show/{{Crypt::encrypt($product->id)}}" class="btn btn-outline-primary mt-3"><i class="fa fa-shopping-cart"></i>&nbsp;Buy Now</a>
            @else
              <b>Out of stock</b>
            @endif

          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
