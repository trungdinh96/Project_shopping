@extends('Admin.layout.master')
<script src="https://cdn.tailwindcss.com"></script>
@section('title'.' List product')

@section('header_content','List Product')
    

@section('content')
<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12">
<a href="{{route('admin.product.create')}}" class="btn btn-success float-right m-2">Add</a>
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
            
            <th scope="col">Action</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
              
          <tr>
            <th scope="row">{{$product->id}}</th>
            <td>{{$product->name}}</td>
            <td>{{$product->price}}</td>
            <td>
              <img src="{{$product->feature_image_path}}" alt="" width="100">
            </td>
            <td>{{$product->category->name}}</td>
            <td>
              <a href="{{route('admin.product.edit',['id' => $product->id])}}" class="btn btn-primary">Edit</a>
              <a href="{{route('admin.product.delete',['id' => $product->id])}}" class="btn btn-danger">Delete</a>
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
    