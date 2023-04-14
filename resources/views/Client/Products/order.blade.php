@extends('Client.layout.master')

@section('content')
    <section id="cart_items">
        <div class="container">
           
            @if(session('success'))
                <div class="alert alert-success">
                {{ session('success') }}
                </div> 
            @endif
            
            @foreach ($orders as $order )
                @php $total = 0 @endphp
                @if (Auth::user()->id== $order->user_id)
                    <div class="card border-dark col-md-12">
                        <div class="card-header">
                            <h5>Mã đơn hàng: DH{{$order->customers->id}}</h5>
                            <h5>Họ và tên:{{$order->customers->name}}</h5>
                            <h5>Email: {{$order->customers->email}}</h5>
                            <h5>Số điện thoại: {{$order->customers->number_phone}}</h5>
                            <h5>Địa chỉ: {{$order->customers->address}}</h5>
                            <h5>Trạng thái: {{$order->status== 0 ? 'Chưa thanh toán' : 'Đã thanh toán'}}</h5>
                        </div>
                        <div class="card-body text-dark">

                            <div class="table-responsive cart_info">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr class="cart_menu">
                                            
                                            <td class="total">Product Image</td>
                                            <td class="total">Product name</td>
                                            <td class="total">Product price</td>
                                            <td class="total">Quantity</td>
                                            <td class="total">Total</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($order->products as $orderProduct )
                                    @php $total += $orderProduct->price * $orderProduct->pivot->quantity @endphp
                                    
                                    <tr >
                                            
                                        <td class="cart_product"><img src="{{$orderProduct->feature_image_path}}" alt="" width="100"></td>
                                        
                                        <td class="cart_description">
                                            <h5>{{$orderProduct->name}}</h5>

                                        </td>
                                        
                                        <td class="cart_price">{{number_format($orderProduct->price)}} VND</td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">

                                                <input class="cart_quantity_input" type="text" name="quantity"
                                                    value="{{$orderProduct->pivot->quantity}}" disabled>

                                            </div>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price">
                                                {{number_format($orderProduct->price * $orderProduct->pivot->quantity)}}  VND
                                            </p>
                                        </td>
                                    
                                        
                                    </tr>
                                    @endforeach
                                        
                                        {{-- @endif --}}
                                    

                                        <tr>
                                            <td colspan="4">&nbsp;</td>
                                            <td colspan="2">
                                                <table class="table table-condensed total-result">

                                                    <tr>
                                                        <td>Total</td>
                                                        <td><span>{{number_format($total)}}</span></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        @if ($order->status == 0)
                                            
                                        <tr>
                                            <td colspan="4">&nbsp;</td>
                                            <td colspan="2">
                                                <table class="table table-condensed total-result">

                                                    <tr>
                                                        <a href="{{ route('client.delete', ['id' => $order->id]) }}" class="btn btn-danger"
                                                            OnClick='return confirm("Are you want to delete ?");'>Cancel order</a>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
           



        </div>
    </section>
    <!--/#cart_items-->
@endsection
