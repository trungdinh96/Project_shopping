@extends('Admin.layout.master')

@section('title' . 'List Category')

@section('header_content', 'List Category')
@section('css')
<script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @can('category-create')
                <div class="col-md-12">
                    <a href="{{ route('admin.category.create') }}" class="btn btn-success float-right m-2">Add</a>
                </div>
            @endcan

            <div class="col-md-12">
                <a href="{{ route('admin.category.deletesoft') }}" class="btn btn-success float-right m-2">Trash</a>
            </div>
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Category name</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr>
                                <th scope="row">{{ $key += 1 }}</th>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @can('category-edit')
                                        <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}"
                                            class="btn btn-primary">Edit</a>
                                    @endcan
                                    @can('category-delete')
                                        <a href="{{ route('admin.category.delete', ['id' => $category->id]) }}"
                                            class="btn btn-danger"
                                            OnClick='return confirm("Are you want to delete ?");'>Delete</a>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-md-12">

                {{ $categories->links() }}
            </div>

        </div>
        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->


@endsection
