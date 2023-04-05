@extends('Admin.layout.master')

@section('title' . 'Create user')
@section('css')
    <link href="{{ BASE_URL }}vendors/select2/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ BASE_URL }}admins/product/add/add.css">

@endsection



@section('header_content', 'Add User')


@section('content')
    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label>Username</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Username"
                            value="{{ old('name') }}">
                        @error('name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email"
                            value="{{ old('email') }}">
                        @error('email')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password"
                            value="{{ old('password') }}">
                        @error('password')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>





                    <div class="form-group">
                        <label>Choose Role</label>
                        <select name="role_id[]" class="form-control role_select_choose" multiple="multiple">
                            <option value=""></option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach

                        </select>
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

@endsection
