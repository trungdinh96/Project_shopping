@extends('Admin.layout.master')

@section('title'.'Edit Category')

@section('header_content','Edit Category')
    

@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-6">
<form action="{{route('admin.category.update',['id' => $category->id])}}" method="POST">
  @csrf
  @if ($errors->any())
      <div class="alert alert-danger text-center">
            Vui lòng kiểm tra lại dự liệu
      </div>
  @endif
    <div class="form-group">
      <label>Category name</label>
      <input type="text" class="form-control"
      name="name"  
       value="{{$category->name}}"
       placeholder="Category name">
      @error('name')
          <span style="color: red">{{$message}}</span>
      @enderror
    </div>
    <div class="form-group">
        <label >Choose parent category</label>
        <select class="form-control" name="parent_id" >
          <option value="0">Chọn danh mục</option>
         {!!$htmlOption!!}
        </select>
    </div>
    <button type="submit" class="btn btn-info ">Update</button>
  </form>
      </div>
    </div>
</div>
@endsection
    
