@extends('Admin.layout.master')

@section('title' . 'Create user')
@section('css')
    <link href="{{ BASE_URL }}vendors/select2/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ BASE_URL }}admins/product/add/add.css">

@endsection



@section('header_content', 'Add Role')


@section('content')
    <form action="{{ route('admin.permission.store') }}" method="POST" enctype="multipart/form-data">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">

                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger text-center">
                            Vui lòng kiểm tra lại dự liệu
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Role name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Username"
                            value="{{ old('name') }}">
                        @error('name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Display name</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="display_name"></textarea>
                        @error('display_name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>



                </div>
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($permissionsParent as $permissionsParentItem)
                            <div class="card border-dark mb-3 col-md-12">
                                <div class="card-header" style="background-color: #00e765">
                                    <label for="">
                                        <input type="checkbox" name="" id="" class="checkbox_wrapper">
                                    </label>
                                    Module {{ $permissionsParentItem->name }}
                                </div>
                                <div class="row">
                                    @foreach ($permissionsParentItem->permissionChild as $permissionChildItem)
                                        <div class="card-body text-dark col-md-3">
                                            <h5 class="card-title">
                                                <label for="">
                                                    <input type="checkbox" name="permission_id[]" id="" class="checkbox_childrent" value="{{$permissionChildItem->id}}">
                                                </label>
                                                {{ $permissionChildItem->name }}
                                            </h5>

                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endforeach
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
    <script src="https://cdn.tiny.cloud/1/vgfaydx2hw1fkclx3znbgzfxwofpw8cwmm2mgns8c3vxacbl/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="{{ BASE_URL }}admins/product/add/add.js"></script>

    <script>
        $('.checkbox_wrapper').on('click', function()
        {
$(this).parents('.card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
        });
    </script>

@endsection
