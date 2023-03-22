@extends('Admin.layout.master')

@section('title'.'Edit Menu')

@section('header_content','Edit Menu')
    

@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-6">
<form action="{{route('admin.menu.update',['id' => $menu->id])}}" method="POST">
  @csrf
  @if ($errors->any())
      <div class="alert alert-danger text-center">
            Vui lòng kiểm tra lại dự liệu
      </div>
  @endif
    <div class="form-group">
      <label>Menu name</label>
      <input type="text" class="form-control"
      name="name"  
       value="{{$menu->name}}"
       placeholder="Menu name">
      @error('name')
          <span style="color: red">{{$message}}</span>
      @enderror
    </div>
    <div class="form-group">
        <label >Choose parent menu</label>
        <select class="form-control" name="parent_id" >
          <option value="0">Chọn menu</option>
         {!!$optionSelect!!}
        </select>
    </div>
    <button type="submit" class="btn btn-info ">Update</button>
  </form>
      </div>
    </div>
</div>
@endsection
    
