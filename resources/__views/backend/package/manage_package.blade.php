@extends('backend.layouts.app')
@section('title', 'List Package')
@section('content')
<div class="text-end mb-3">
    <a href="{{ route('backend.package-add') }}" class="btn btn-primary "><i class="mdi mdi-plus"></i>Add package</a>
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
                    <th>Package Name</th>
                    <th>Package Category</th>
                    <th>Package Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 1; ?>
                @foreach($packages as $package)
                    <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $package->package_name }}</td>
                    <td>{{ $package->package_category->package_name }}</td>
                    <td>{!! $package->package_description !!}</td>
                    <td><img src="{{ url('/') }}/{{ $package->image }}" width="100"></td>
                        @if($package->id != 0)
                        <td>
                            <a href="{{ route('backend.edit-package', $package->id) }}" class="btn btn-sm btn-success"><i class="mdi mdi-file-edit-outline"></i></a>
                           <a href="{{ route('backend.delete-package', $package->id) }}" id="delete" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can-outline"></i></a>
                         
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