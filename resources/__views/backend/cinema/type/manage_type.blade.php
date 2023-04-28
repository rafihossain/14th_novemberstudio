@extends('backend.layouts.app')
@section('title', 'List Blog Category')
@section('content')
<div class="text-end mb-3">
    <a href="{{ route('backend.add-type') }}" class="btn btn-primary "><i class="mdi mdi-plus"></i>Add Type</a>
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
                    <th>Type Name</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 1; ?>
                @foreach($types as $type)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $type['type_name'] }}</td>
                       @if($type['id'] != 0)
                        <td>
                            <a href="{{ route('backend.edit-type', $type['id']) }}" class="btn btn-sm btn-success"><i class="mdi mdi-file-edit-outline"></i></a>
                            <a href="{{ route('backend.delete-type', $type['id']) }}" id="delete" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can-outline"></i></a>
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