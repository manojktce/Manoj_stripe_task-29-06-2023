@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left"></div>
            <div class="pull-right">
                <a class="btn btn-outline-primary" href="{{ route('home') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a>
            </div>
        </div>
    </div>
    @if(count($orders)<1)
        <div class="row mb-2">
            <h5><b>No Orders</b></h5>
        </div>
    @endif
    @foreach($orders as $order)
        <div class="row mb-2">
            <div class="col-12 col-sm-8 col-md-6 col-lg-8">
                <div class="card">
                    <img class="card-img" src="{{ URL::asset('public/images/'.$order->thumbnail) }}" alt="{{ $order->name }}" height="250px">

                    <div class="card-body">
                      <h4 class="card-title">{{ $order->name }}</h4>
                      <p class="card-text">{{ $order->description }}</p>
                      <b>Price : </b><h5>{{ $order->amount }}</h5>
                      <b>Quantity : </b><h5>{{ $order->quantity }}</h5>
                      <b>Total Price : </b><h5>{{ $order->amount * $order->quantity }}</h5>
                      <a href="{{ $order->invoice }}" target="_blank">Invoice</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
