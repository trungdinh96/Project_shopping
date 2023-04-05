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
            <th scope="col">Category name</th>
           
            <th scope="col">Action</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach ($categorySoftDelete as $key => $category)
              
          <tr>
            <th scope="row">{{$key +=1}}</th>
            <td>{{$category->name}}</td>
            
            <td>
              <a href="{{route('admin.category.restore',['id' => $category->id])}}" class="btn btn-primary" OnClick='return confirm("Are you want to restore product ?");'>Resore</a>
              <a href="{{route('admin.category.deleteTrash',['id' => $category->id])}}" class="btn btn-danger" OnClick='return confirm("Are you want to delete ?");'>Delete</a>
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
    