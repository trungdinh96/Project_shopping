@extends('Admin.layout.master')

@section('title' . ' List product')

@section('header_content', 'List Product')

@section('css')
<script src="https://cdn.tailwindcss.com"></script>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @can('product-create')
                <div class="col-md-12">
                    <a href="{{ route('admin.product.create') }}" class="btn btn-success float-right m-2">Add</a>
                </div>
            @endcan

            <div class="col-md-12">
                <a href="{{ route('admin.product.deletesoft') }}" class="btn btn-success float-right m-2">Trash</a>
            </div>
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Product name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Image</th>
                            <th scope="col">Category</th>
                            <th scope="col">Person add</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <th scope="row">{{ $key += 1 }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ number_format($product->price) }}</td>
                                <td>
                                    <img src="{{ $product->feature_image_path }}" alt="" width="100">
                                </td>
                                <td>{{ optional($product->categorys)->name }}</td>
                                <td>{{ optional($product->user)->name }}</td>
                                <td>
                                    @can('product-edit')
                                        <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}"
                                            class="btn btn-primary">Edit</a>
                                    @endcan
                                    @can('product-delete')
                                        <a href="{{ route('admin.product.delete', ['id' => $product->id]) }}"
                                            class="btn btn-danger"
                                            OnClick='return confirm("Are you want to delete ?");'>Delete</a>
                                    @endcan

                                </td>


                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-md-12">


                {{ $products->links() }}
            </div>

        </div>
        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->


@endsection
