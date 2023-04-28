@extends('backend.layouts.app')

@section('content')
 

<div class="card">
    <div class="card-body">
     <form method="post" action="{{route('backend.post-setting')}}">
    @csrf
	<div class="card">
		<div class="card-body">
         <div class="form-group mb-2">
            <label>Social Link</label>
            <div class="input-group mb-2">
                <div class="input-group-text">Facebook</div>
                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Facebook" name="facebook" value="{{$social_link[0]->settings_value}}">
            </div>
            @error('facebook')
            <strong class="text-danger">{{ $message }}</strong>
            @enderror
            <!--<div class="input-group mb-2">-->
            <!--    <div class="input-group-text">Twitter</div>-->
            <!--    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Twitter" name="twitter" value="{{$social_link[1]->settings_value}}">-->
            <!--</div>-->
            @error('twitter')
            <strong class="text-danger">{{ $message }}</strong>
            @enderror
            <div class="input-group mb-2">
                <div class="input-group-text">Vimeo</div>
                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Vimeo" name="vimeo" value="{{$social_link[2]->settings_value}}">
            </div>
            @error('pinterest')
            <strong class="text-danger">{{ $message }}</strong>
            @enderror
            <div class="input-group mb-2">
                <div class="input-group-text">Instagram</div>
                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Instagram" name="instagram" value="{{$social_link[3]->settings_value}}">
            </div>
            @error('instagram')
            <strong class="text-danger">{{ $message }}</strong>
            @enderror
            <!--<div class="input-group mb-2">-->
            <!--    <div class="input-group-text">Linkedin</div>-->
            <!--    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Linkedin" name="linkedin" value="{{$social_link[4]->settings_value}}">-->
            <!--</div>-->
            @error('linkedin')
            <strong class="text-danger">{{ $message }}</strong>
            @enderror
            <!--<div class="input-group mb-2">-->
            <!--    <div class="input-group-text">Youtube</div>-->
            <!--    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="youtube" name="youtube" value="{{$social_link[5]->settings_value}}">-->
            <!--</div>-->
            @error('youtube')
            <strong class="text-danger">{{ $message }}</strong>
            @enderror
        </div>
			<!--<div class="form-check form-switch mb-2">-->
   <!--             <input type="checkbox" class="form-check-input" id="facebookscript" name="social_link_publish" value="yes" @if($social_link[6]->settings_value == 'yes')checked @endif>-->
   <!--             <label class="form-check-label" for="facebookscript">Publish</label>-->
              
   <!--         </div>-->
            @error('google_analytics_publish')
                <strong class="text-danger">{{ $message }}</strong>
            @enderror
		</div>
	</div>
 
	<div class="text-center">
        <button class="btn btn-primary" type="submit"> Update Social </button>
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