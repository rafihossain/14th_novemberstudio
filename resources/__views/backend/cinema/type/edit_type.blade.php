@extends('backend.layouts.app')
@section('title', 'Edit Type')
@section('content')
<div class="card">
	<div class="card-body">
		<form id="formCategory" action="{{route('backend.update-type')}}" method="POST" enctype="multipart/form-data">
            @csrf
			<div class="form-group mb-2">
				<label>Type Name</label>
				<input type="hidden" name="id" value="{{ $type->id }}">
				<input type="text" class="form-control @error('type_name') is-invalid @enderror" name="type_name"
				value="{{ $type->type_name }}">
                @error('type_name')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
            
            
			<div class="text-center">
		        <button class="btn btn-primary" type="submit"> Update Type </button>
		    </div>
		</form>
	</div>
</div>

@endsection