@extends('backend.layouts.app')
@section('title', 'List Testimonial')
@section('content')
<div class="text-end mb-3">
    <a href="{{ route('backend.add-testimonial') }}" class="btn btn-primary "><i class="mdi mdi-plus"></i>Add testmonial</a>
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
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
				@foreach($testimonials as $testimonial)
					<tr>
                        <td>{{ $testimonial->user_name }}</td>
						@if($testimonial->user_status == 1)
						<td><span class="badge bg-success rounded-pill">Publish</span></td> 
						@else
						<td><span class="badge bg-danger rounded-pill">Unpublish</span></td> 
						@endif
                        <td>
                            <a href="{{route('backend.edit-testimonial', ['id' => $testimonial->id] )}}" class="btn btn-sm btn-success"><i class="mdi mdi-file-edit-outline"></i></a>
							<a href="{{route('backend.delete-testimonial', ['id' => $testimonial->id] )}}" id="delete" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can-outline"></i></a>
                        </td>
					</tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection