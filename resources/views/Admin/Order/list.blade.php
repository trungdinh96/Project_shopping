@extends('Admin.layout.master')

@section('header_content', 'order')
@section('css')
    <script src="https://cdn.tailwindcss.com"></script>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            {{-- @can('product-create')
        @endcan --}}
            {{-- <div class="col-md-12">
                <a href="{{ route('admin.product.create') }}" class="btn btn-success float-right m-2">Add</a>
            </div> --}}

            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Customer name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone number</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">MHD{{ $order->customers->id }}</th>
                                <td>{{ $order->customers->name }}</td>
                                <td>{{ $order->customers->email }}</td>

                                <td>{{ $order->customers->address }}</td>
                                <td>{{ $order->customers->number_phone }}</td>
                                <td>{{ $order->status == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}</td>
                                <td>
                                    @can('update-order')
                                        
                                    @if ( $order->status == 0)
                                        
                                    <a href="{{ route('admin.order.updateStatus', ['id' => $order->id , 'status'=>1]) }}"
                                        class="btn btn-success">Confirm</a>
                                    @endif
                                    @endcan

                                    
                                    <a href="{{ route('admin.order.detail', ['id' => $order->id]) }}" class="btn btn-primary">Detail</a>
                                    @can('delete_order')
                                        
                                    <a href="{{ route('admin.order.delete', ['id' => $order->id]) }}" class="btn btn-danger"
                                        OnClick='return confirm("Are you want to delete ?");'>Delete</a>
                                    @endcan


                                </td>


                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-md-12">


                {{ $orders->links() }}
            </div>

        </div>
        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
@endsection
