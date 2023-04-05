@extends('Admin.layout.master')

@section('title' . 'Edit user')
@section('css')
    <link href="{{ BASE_URL }}vendors/select2/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ BASE_URL }}admins/product/add/add.css">

@endsection



@section('header_content', 'Edit User')


@section('content')
    <form action="{{ route('admin.user.update',['id'=>$user->id]) }}" method="POST" enctype="multipart/form-data">
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
                        <label>Choose Role</label>
                        <select name="role_id[]" class="form-control role_select_choose" multiple="multiple">
                            <option value=""></option>
                            @foreach ($roles as $role)
                            <option {{$rolesOfUser->contains('id',$role->id) ? 'selected' : ''}}
                                 value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach

                        </select>
                    </div>

                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>

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
