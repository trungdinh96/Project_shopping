@extends('Admin.layout.master')

@section('title' . 'Create product')
@section('css')
    <link href="{{ BASE_URL }}vendors/select2/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ BASE_URL }}admins/product/add/add.css">

@endsection



@section('header_content', 'Add Product')


@section('content')
    <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-6">

                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger text-center">
                            Vui lòng kiểm tra lại dự liệu
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Product name</label>
                        <input type="text" class="form-control" name="name" placeholder="Product name">
                        @error('name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Product price</label>
                        <input type="text" class="form-control" name="price" placeholder="Product price">
                        @error('name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Product Image</label>
                        <input type="file" class="form-control-file" name="feature_image_path">
                        @error('name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Product Image detail</label>
                        <input type="file" multiple class="form-control-file" name="image_path[]">
                        @error('name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Choose Category</label>
                        <select class="form-control select2_init" name="category_id">
                            <option value="">Chọn danh muc</option>
                            {!! $htmlOption !!}
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Enter tags for products</label>
                        <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
                        </select>
                    </div>

                </div>
                <div class="col-md-10">

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Content</label>
                        <textarea class="form-control tinymce_editor_init" id="exampleFormControlTextarea1" rows="12" name="content"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Add new</button>

                </div>

            </div>
        </div>
    </form>
@endsection

@section('js')
    <script src="{{ BASE_URL }}vendors/select2/select2.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/vgfaydx2hw1fkclx3znbgzfxwofpw8cwmm2mgns8c3vxacbl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ BASE_URL }}admins/product/add/add.js"></script>

@endsection
