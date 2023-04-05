@extends('Admin.layout.master')
<script src="https://cdn.tailwindcss.com"></script>
@section('title'.' List product')

@section('header_content','Trash')
    

@section('content')
<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    
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
          @foreach ($productSoftDelete as $key => $product)
              
          <tr>
            <th scope="row">{{$key +=1}}</th>
            <td>{{$product->name}}</td>
            <td>{{number_format($product->price)}}</td>
            <td>
              <img src="{{$product->feature_image_path}}" alt="" width="100">
            </td>
            <td>{{optional($product->categorys)->name}}</td>
            <td>{{$product->user->name}}</td>
            <td>
              <a href="{{route('admin.product.restore',['id' => $product->id])}}" class="btn btn-primary" OnClick='return confirm("Are you want to restore product ?");'>Resore</a>
              <a href="{{route('admin.product.deleteTrash',['id' => $product->id])}}" class="btn btn-danger" OnClick='return confirm("Are you want to delete ?");'>Delete</a>
            </td>
            
           
          </tr>
          @endforeach
         
        </tbody>
      </table>
    </div>
    {{-- <div class="col-md-12">

      
      {{ $productSoftDelete->links() }}
    </div> --}}
    
  </div>
  <!-- /.row -->
  <!-- Main row -->
  
  <!-- /.row (main row) -->
</div><!-- /.container-fluid -->

  
@endsection
    