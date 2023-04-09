@extends('Admin.layout.master')

@section('title' . ' List Role')

@section('header_content', 'List Roles')

@section('css')
<script src="https://cdn.tailwindcss.com"></script>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @can('roles-create')
                <div class="col-md-12">
                    <a href="{{ route('admin.permission.create') }}" class="btn btn-success float-right m-2">Add</a>
                </div>
            @endcan

            <div class="col-md-12">
                {{-- <a href="{{route('admin.user.deletesoft')}}" class="btn btn-success float-right m-2">Trash</a> --}}
            </div>
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Role name</th>
                            <th scope="col">Display name</th>


                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <th scope="row">{{ $key += 1 }}</th>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->display_name }}</td>



                                <td>
                                    @can('roles-edit')
                                        <a href="{{ route('admin.permission.edit', ['id' => $role->id]) }}"
                                            class="btn btn-primary">Edit</a>
                                    @endcan

                                    <a href="{{ route('admin.permission.delete', ['id' => $role->id]) }}"
                                        class="btn btn-danger"
                                        OnClick='return confirm("Are you want to delete ?");'>Delete</a>
                                </td>


                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-md-12">


                {{ $roles->links() }}
            </div>

        </div>
        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->


@endsection
