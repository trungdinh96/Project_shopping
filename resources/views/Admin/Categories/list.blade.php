@extends('Admin.layout.master')

@section('title'.'List Category')

@section('header_content','List Category')
    

@section('content')
<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12">
<a href="{{route('admin.category.create')}}" class="btn btn-success float-right m-2">Add</a>
    </div>
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
          @foreach ($categories as $category)
              
          <tr>
            <th scope="row">{{$category->id}}</th>
            <td>{{$category->name}}</td>
            <td>
              <a href="{{route('admin.category.edit',['id' => $category->id])}}" class="btn btn-primary">Edit</a>
              <a href="{{route('admin.category.delete',['id' => $category->id])}}" class="btn btn-danger">Delete</a>
            </td>
           
          </tr>
          @endforeach
         
        </tbody>
      </table>
    </div>
    <div class="col-md-12">
      {{ $categories->links() }}
    </div>
  </div>
  <!-- /.row -->
  <!-- Main row -->
  
  <!-- /.row (main row) -->
</div><!-- /.container-fluid -->

  
@endsection
    