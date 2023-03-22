@extends('Admin.layout.master')
<script src="https://cdn.tailwindcss.com"></script>
@section('title'.' List Menu')

@section('header_content','List Menu')
    

@section('content')
<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12">
<a href="{{route('admin.menu.create')}}" class="btn btn-success float-right m-2">Add</a>
    </div>
    <div class="col-md-12">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Menu name</th>
            <th scope="col">Action</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach ($menus as $menu)
              
          <tr>
            <th scope="row">{{$menu->id}}</th>
            <td>{{$menu->name}}</td>
            <td>
              <a href="{{route('admin.menu.edit',['id' => $menu->id])}}" class="btn btn-primary">Edit</a>
              <a href="{{route('admin.menu.delete',['id' => $menu->id])}}" class="btn btn-danger">Delete</a>
            </td>
           
          </tr>
          @endforeach
         
        </tbody>
      </table>
    </div>
    <div class="col-md-12">

      
      {{ $menus->links() }}
    </div>
    
  </div>
  <!-- /.row -->
  <!-- Main row -->
  
  <!-- /.row (main row) -->
</div><!-- /.container-fluid -->

  
@endsection
    