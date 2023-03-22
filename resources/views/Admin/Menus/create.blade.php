@extends('Admin.layout.master')

@section('title'.'Add Menu')

@section('header_content','Add Menu')
    

@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-6">
<form action="{{route('admin.menu.store')}}" method="POST">
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
       placeholder="Menu name">
      @error('name')
          <span style="color: red">{{$message}}</span>
      @enderror
    </div>
    <div class="form-group">
        <label >Choose parent Menu</label>
        <select class="form-control" name="parent_id" >
          <option value="0">Chọn menu cha</option>
         {!!$optionSelect!!}
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Add new</button>
  </form>
      </div>
    </div>
</div>
@endsection
    
