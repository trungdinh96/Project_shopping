@extends('Client.layout.master')


@section('content')
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
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img src="{{$products->feature_image_path}}" alt="" />
                            <h3>ZOOM</h3>
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">
                            
                              <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    @foreach ($products->images as $key => $product)
                                      
                                                <a href=""><img src="{{$product->image_path}}" alt="" width="100"></a>
                                       
                                         
                                    @endforeach
                                   
                                    
                                </div>

                              <!-- Controls -->
                              {{-- <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                              </a>
                              <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                              </a> --}}
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                            <h2>{{$products->name}}</h2>
                            <p>Web ID: {{$products->id}}</p>
                            <img src="images/product-details/rating.png" alt="" />
                            <span>
                                <span>{{number_format($products->price)}}</span>
                                
                                <button type="button" class="btn btn-fefault cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </button>
                            </span>
                            <p><b>Availability:</b> In Stock</p>
                            <p><b>Condition:</b> New</p>
                            <p><b>Brand:</b> E-SHOPPER</p>
                            <a href="{{route('client.addToCart',['id'=>$products->id])}}"><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->
                
                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#details_{{$products->category_id}}" data-toggle="tab">Similar products</a></li>
                           
                            <li class="active"><a href="#reviews" data-toggle="tab">Product Profile </a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="details_{{$products->category_id}}" >
                            @foreach ($productCategorys as $productCategory)
                                
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <a href="{{route('client.productdetail',['id'=>$productCategory->id])}}">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{$productCategory->feature_image_path}}" alt="" />
                                                <h2>{{number_format($productCategory->price)}}</h2>
                                                <p>{{$productCategory->name}}</p>
                                                <button type="button" class="btn btn-default add-to-cart"><a href="{{route('client.addToCart',['id'=>$productCategory->id])}}"><i class="fa fa-shopping-cart"></i>Add to cart</a></button>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-md-12">


                                {{ $productCategorys->links() }}
                            </div>   
                        </div>
                        
                       
                        
                        <div class="tab-pane fade active in" id="reviews" >
                            <div class="col-sm-12">
                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                </ul>
                               
                                
                                <form action="#">
                                  
                                    
                                    <p>{!!$products->content!!}</p>
                                   
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div><!--/category-tab-->
                
              @include('Client.Home.recommendProduct')
                
            </div>
        </div>
    </div>
</section>

@endsection