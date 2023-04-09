@extends('Client.layout.master')

@section('content')

<section id="advertisement">
    <div class="container">
        <img src="{{ BASE_URL }}Clients/images/shop/advertisement.jpg" alt="" />
    </div>
</section>

<section>
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
    @endif
        <div class="row">
            @include('Client.layout.sidebar')
            
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Features Items</h2>
                    @foreach ($products as $product )
                        
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ $product->feature_image_path }}" alt="" />
                                    <h2>{{ number_format($product->price) }} VND</h2>
                                    <p>{{ $product->name }}</p>
                                   
                                </div>
                                <div class="product-overlay">
                                    <a href="{{route('client.productdetail',['id'=>$product->id])}}">

                                        <div class="overlay-content">
                                            <h2>{{ number_format($product->price) }} VND</h2>
                                            <p>{{ $product->name }}</p>
                                            <a href="{{route('client.addToCart',['id'=>$product->id])}}"
                                             
                                               class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart">
                                                </i>Add to cart</a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    @endforeach
                  
                    
                  
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')

@endsection
