@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12 col-sm-8 col-md-6 col-lg-8">
        <div class="card">
            <img class="card-img" src="{{ URL::asset('public/images/'.$product->thumbnail) }}" alt="{{ $product->name }}" height="250px">

            <div class="card-body">
              <h4 class="card-title">{{ $product->name }}</h4>
              <h6 class="card-subtitle mb-2 text-muted">{{ $product->name }}</h6>
              <p class="card-text">{{ $product->description }}</p>
              <h3>{{ $product->price }}</h3>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <div class="row mb-2">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left"></div>
                    <div class="pull-right">
                        <a class="btn btn-outline-primary" href="{{ route('home') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a>
                    </div>
                </div>
            </div>

        <form action="{{ route('stripe.post') }}" method="POST"> 
            @csrf 
            <input type="hidden" name="product_id" value="{{ $product->id }}"> 
            <input type="hidden" name="product_price" id="price" value="{{ $product->price }}"> 
            <div class="row mb-3">
                <label>Quantity</label>
                @php $qty_limit = $product->quantity; @endphp
                <select class="form-control" name="quantity" id="qty">
                    @for($i=1; $i<=$qty_limit ; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @if($i==3)
                            @break
                        @endif
                    @endfor
                </select>
            </div>
                
            <div class="row mb-3">
                <label>Total Amount : </label>
                <p id="tot_amt">{{ $product->price }}</p>
            </div>

            <hr>
            <p align="center">
            <script 
                src="https://checkout.stripe.com/checkout.js" class="stripe-button" 
                id="chek-button"
                data-key="{{ env('STRIPE_KEY') }}" 
                data-name="{{ $product->name }}"
                data-description="{{ $product->description }}"
                data-currency="usd"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-locale="auto" data-label="Pay">
            </script> 
            </p>
        </form>
  </div>
</div>
<script type="text/javascript">
    $('#qty').change(function(e){
        let price   = $('#price').val();
        let qty     = $('#qty').val();
        let tot     = price * qty;
        $('#tot_amt').text(tot);
    });
</script>
@endsection
