@extends('backend.layouts.app')
@section('title', 'List Blog Category')
@section('content')
<div class="text-end mb-3">
    <a href="{{ route('backend.add-category') }}" class="btn btn-primary "><i class="mdi mdi-plus"></i>Add Category</a>
</div>

@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body">
        <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
            <thead>
                <tr>
                    <th>SL No</th>
                    <th>Category Name</th>
                    <th>Category Image</th>
                    <th>Category Icon</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 1; ?>
                @foreach($cinemaCategories as $category)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $category->category_name }}</td>
                         <td><img src="{{ url('/') }}/{{ $category->image }}" width='100'></td>
                          <td style="background: black; text-align: center; padding-top: 50px;"><img src="{{ url('/') }}/{{ $category->icon }}" width='50'></td>
                        @if($category->id != 0)
                        <td>
                            <a href="{{ route('backend.edit-category', $category->id) }}" class="btn btn-sm btn-success"><i class="mdi mdi-file-edit-outline"></i></a>
                            <a href="{{ route('backend.delete-category', $category->id) }}" id="delete" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can-outline"></i></a>
                        </td>
                        @endif
                    </tr>
                <?php $i++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection