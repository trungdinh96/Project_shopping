@extends('Admin.layout.master')

@section('title'.'Add Category')

@section('header_content','Add Category')
    

@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-6">
<form>
    <div class="form-group">
      <label>Category name</label>
      <input type="text" class="form-control"   placeholder="Category name">
      
    </div>
    <div class="form-group">
        <label >Choose parent category</label>
        <select class="form-control" >
          <option value="0">Chọn danh mục</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
      </div>
    </div>
</div>
@endsection
    
