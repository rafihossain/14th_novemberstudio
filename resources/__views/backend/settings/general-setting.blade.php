@extends('backend.layouts.app')

@section('content')

@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body">
     <form method="post" action="{{route('backend.update-general')}}" enctype="multipart/form-data">
    @csrf
	<div class="card">
		<div class="card-body">
            <div class="form-group mb-2">
                <label>Address</label>
                <div class="input-group mb-2">
                    <div class="input-group-text">Address</div>
                    <textarea name="address" id="" class="form-control">{{$general_settings[0]->settings_value}}</textarea>
                </div>
                @error('address')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label>Phone</label>
                <div class="input-group mb-2">
                    <div class="input-group-text">Phone</div>
                    <input type="text" class="form-control" id="" name="phone" value="{{$general_settings[1]->settings_value}}">
                </div>
                @error('phone')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label>Email</label>
                <div class="input-group mb-2">
                    <div class="input-group-text">Email</div>
                    <input type="text" class="form-control" id="" name="email" value="{{$general_settings[2]->settings_value}}">
                </div>
                @error('email')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label>Footer Logo</label>
				<input type="file" class="dropify" name="footer_logo"
				data-default-file="{{ asset('images/general_settings/'.$general_settings[3]->settings_value)}}">
                <input type="hidden" value="{{$general_settings[3]->settings_value}}" name="old_footer_logo">
                @error('footer_logo')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
            <div class="form-group mb-2">
                <label>Footer About us</label>
				<textarea name="footer_about_us" id="" cols="30" rows="5" class="form-control">{{$general_settings[4]->settings_value}}</textarea>
                @error('footer_about_us')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
		</div>
	</div>
 
	<div class="text-center">
        <button class="btn btn-primary" type="submit"> Save Settings </button>
    </div>
</form> 

    </div>
</div>

@endsection
@section('script')
 <script type="text/javascript">
     $('.dropify').dropify();
 </script>

@endsection