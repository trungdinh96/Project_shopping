@extends('Client.layout.master')

@section('css')
<link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

<!-- Css Styles -->
{{--  --}}
<link rel="stylesheet" href="{{BASE_URL}}Clients/shoppingcart/css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="{{BASE_URL}}Clients/shoppingcart/css/themify-icons.css" type="text/css">
<link rel="stylesheet" href="{{BASE_URL}}Clients/shoppingcart/css/elegant-icons.css" type="text/css">
<link rel="stylesheet" href="{{BASE_URL}}Clients/shoppingcart/css/owl.carousel.min.css" type="text/css">
<link rel="stylesheet" href="{{BASE_URL}}Clients/shoppingcart/css/nice-select.css" type="text/css">
<link rel="stylesheet" href="{{BASE_URL}}Clients/shoppingcart/css/jquery-ui.min.css" type="text/css">
<link rel="stylesheet" href="{{BASE_URL}}Clients/shoppingcart/css/slicknav.min.css" type="text/css">
<link rel="stylesheet" href="{{BASE_URL}}Clients/shoppingcart/css/style.css" type="text/css"> 
@endsection
@section('content')
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th class="p-name">Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Delete</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @if(session('cart'))
                               @foreach(session('cart') as $id => $details)
                               {{-- @if (Auth::user()->id == $details['auth']) --}}
                                   
                               @php $total += $details['price'] * $details['quantity'] @endphp
                            <tr data-id="{{ $id }}">
                                
                                <td class="cart-pic first-row"><img src="{{ $details['image'] }}" alt=""></td>
                                <td class="cart-title first-row">
                                    <h5>{{ $details['name'] }}</h5>
                                </td>
                                <td class="p-price first-row">{{ number_format($details['price']) }} VND</td>
                                <td data-th="Quantity">
                                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity cart_update" min="1" />
                                </td>
                                <td class="total-price first-row">{{number_format($details['price'] * $details['quantity'])  }} VND</td>
                                <td class="close-td first-row cart_remove"><i class="ti-close"></i></td>
                               
                                
                            </tr>
                               {{-- @endif --}}
                            @endforeach
                            @endif
                           
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 offset-lg-8">
                        <div class="proceed-checkout">
                            
                            @if (Auth::check())
                            <ul>
                                <li class="subtotal">Subtotal <span>{{number_format($total)}} VND</span></li>
                                <li class="cart-total">Total <span>{{number_format($total)}} VND</span></li>
                            </ul>
                            <a href="{{route('client.checkout')}}" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            @else
                            <h5 style="color: red">Vui lòng đăng nhập để đặt hàng ! <a href="/login"><b>Đăng nhập</b></a></h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
<script src="{{BASE_URL}}Clients/shoppingcart/js/jquery-3.3.1.min.js"></script>
<script src="{{BASE_URL}}Clients/shoppingcart/js/bootstrap.min.js"></script>
<script src="{{BASE_URL}}Clients/shoppingcart/js/jquery-ui.min.js"></script>
<script src="{{BASE_URL}}Clients/shoppingcart/js/jquery.countdown.min.js"></script>
<script src="{{BASE_URL}}Clients/shoppingcart/js/jquery.nice-select.min.js"></script>
<script src="{{BASE_URL}}Clients/shoppingcart/js/jquery.zoom.min.js"></script>
<script src="{{BASE_URL}}Clients/shoppingcart/js/jquery.dd.min.js"></script>
<script src="{{BASE_URL}}Clients/shoppingcart/js/jquery.slicknav.js"></script>
<script src="{{BASE_URL}}Clients/shoppingcart/js/owl.carousel.min.js"></script>
<script src="{{BASE_URL}}Clients/shoppingcart/js/main.js"></script>
<script type="text/javascript">
   
    $(".cart_update").change(function (e) {
        e.preventDefault();
   
        var ele = $(this);
   
        $.ajax({
            url: '{{ route('update_cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
   
    $(".cart_remove").click(function (e) {
        e.preventDefault();
   
        var ele = $(this);
   
        if(confirm("Do you really want to remove?")) {
            $.ajax({
                url: '{{ route('remove_from_cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
   
</script>
@endsection