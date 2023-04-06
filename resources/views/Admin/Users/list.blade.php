@extends('Admin.layout.master')
<script src="https://cdn.tailwindcss.com"></script>
@section('title' . ' List product')

@section('header_content', 'List User')


@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @can('user-create')
                <div class="col-md-12">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-success float-right m-2">Add</a>
                </div>
            @endcan

            <div class="col-md-12">
                <a href="{{ route('admin.user.deletesoft') }}" class="btn btn-success float-right m-2">Trash</a>
            </div>
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>

                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <th scope="row">{{ $key += 1 }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>

                                <td>
                                    @foreach ($user->roles as $userRole)
                                        {{ $userRole->name }},
                                    @endforeach

                                </td>

                                <td>
                                    @can('user-edit')
                                        <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}"
                                            class="btn btn-primary">Edit</a>
                                    @endcan
                                    @can('user-delete')
                                        <a href="{{ route('admin.user.delete', ['id' => $user->id]) }}" class="btn btn-danger"
                                            OnClick='return confirm("Are you want to delete ?");'>Delete</a>
                                    @endcan

                                </td>


                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-md-12">


                {{ $users->links() }}
            </div>

        </div>
        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->


@endsection
