@extends('backend.layouts.app')
@section('title', 'Add Type')
@section('content')
<div class="card">
	<div class="card-body">
		<form id="formCategory" action="{{route('backend.save-type')}}" method="POST" enctype="multipart/form-data">
            @csrf
			<div class="form-group mb-2">
				<label>Type Name</label>
				<input type="text" class="form-control @error('type_name') is-invalid @enderror" name="type_name"
				value="{{old('type_name')}}">
                @error('type_name')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
		
			<div class="text-center">
		        <button class="btn btn-primary" type="submit"> Add Type</button>
		    </div>
		</form>
	</div>
</div>
@endsection