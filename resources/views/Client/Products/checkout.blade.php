@extends('Client.layout.master')

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div>
            <!--/breadcrums-->




            <div class="shopper-informations">
                <div class="row">
                    {{-- <div class="col-sm-3">
                    <div class="shopper-info">
                        <p>Shopper Information</p>
                        <form>
                            <input type="text" placeholder="Display Name">
                            <input type="text" placeholder="User Name">
                            <input type="password" placeholder="Password">
                            <input type="password" placeholder="Confirm password">
                        </form>
                        <a class="btn btn-primary" href="">Get Quotes</a>
                        <a class="btn btn-primary" href="">Continue</a>
                    </div>
                </div> --}}

                    <div class=" col-md-4 bill-to">
                        <p>Bill To</p>
                        <div class="form-one">
                            <form>
                                
                                <input type="text" placeholder="Email*">
                                
                                <input type="text" placeholder="Full Name *">
                                
                                <input type="text" placeholder="Mobile Phone">
                                <input type="text" placeholder="Address">
                            </form>
                        </div>

                    </div>

                    <div class="col-md-8">
                        <div class="review-payment">
                            <h2>Review & Payment</h2>
                        </div>
                        <div class="table-responsive cart_info">
                            <table class="table table-condensed">
                                <thead>
                                    <tr class="cart_menu">
                                        <td class="image">Item</td>
                                        <td class="name">Product name</td>
                                        <td class="price">Price</td>
                                        <td class="quantity">Quantity</td>
                                        <td class="total">Total</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                    

                                    @php $total = 0 @endphp
                                    @if(session('cart'))
                                        @foreach(session('cart') as $id => $details)
                                        {{-- @if (Auth::user()->id == $details['auth']) --}}
                                            
                                            @php $total += $details['price'] * $details['quantity'] @endphp
                                            <tr data-id="{{ $id }}">
                                                <td class="cart_product">
                                                    <a href=""><img src="{{ $details['image'] }}" alt="" width="100"></a>
                                                </td>
                                                <td class="cart_description">
                                                    <h4>{{ $details['name'] }}</h4>
                                                
                                                </td>
                                                <td class="cart_price">
                                                    <p>{{ number_format($details['price']) }} VND</p>
                                                </td>
                                                <td class="cart_quantity">
                                                    <div class="cart_quantity_button">
                                                        
                                                        <input class="cart_quantity_input" type="text" name="quantity"
                                                            value="{{ $details['quantity'] }}"  disabled>
                                                        
                                                    </div>
                                                </td>
                                                <td class="cart_total">
                                                    <p class="cart_total_price">{{number_format($details['price'] * $details['quantity'])  }} VND</p>
                                                </td>
                                                <td class="cart_remove">
                                                    <i class="fa fa-times"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                   
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                        <td colspan="2">
                                            <table class="table table-condensed total-result">
                                                
                                               
                                                <tr>
                                                    <td>Total</td>
                                                    <td><span>{{number_format($total)}} VND</span></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                           
                        </div>
                        <div class="payment-options">
                            <span>
                                <label><input type="checkbox"> Direct Bank Transfer</label>
                            </span>
                            <span>
                                <label><input type="checkbox"> Check Payment</label>
                            </span>
                            <span>
                                <label><input type="checkbox"> Paypal</label>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="review-payment">
                <h2>Review & Payment</h2>
            </div>


           
        </div>
    </section>
    <!--/#cart_items-->
@endsection

@section('js')
    <script>
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
