@extends('backend.layouts.app')
@section('title', 'Edit cinema')
@section('content')
<div class="card">
	<div class="card-body">
		<form id="formcinemaedit" action="{{route('backend.update-cinema')}}" method="POST" enctype="multipart/form-data">
            @csrf
			<input type="hidden" name="id" value="{{$cinema->id}}">

			<div class="form-group mb-2">
				<label>Cinema Title</label>
				<input type="text" class="form-control @error('cinema_title') is-invalid @enderror" name="cinema_title"
                value="{{$cinema->cinema_title}}">
                @error('cinema_title')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
			<div class="form-group mb-2">
				<label>Slug Url</label>
				<input type="text" class="form-control @error('cinema_slug') is-invalid @enderror" name="cinema_slug"
                value="{{$cinema->cinema_slug}}">
                @error('cinema_slug')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
			<div class="form-group mb-2">
				<label>Meta Title</label>
				<input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title"
                value="{{$cinema->meta_title}}">
                @error('meta_title')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
			<div class="form-group mb-2">
				<label>Meta Keywords</label>
				<input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords"
                value="{{$cinema->meta_keywords}}">
                @error('meta_keywords')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
			<div class="form-group mb-2">
				<label>Meta Description</label>
				<input type="text" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description"
                value="{{$cinema->meta_description}}">
                @error('meta_description')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
		
			<div class="form-group mb-2">
				<label>Cinema Category</label>
                <select name="cinema_category_id" class="form-control @error('cinema_category') is-invalid @enderror" id="">
                    @foreach($cinemaCategories as $category)
                        <option value="{{ $category->id }}" 
                        {{ $category->category_name == $cinema->category->category_name ? 'selected' : '' }} >
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>

                @error('cinema_category')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
			
				<div class="form-group mb-2">
                <label>Type</label>
                <select name="type" class="form-control @error('type') is-invalid @enderror"
                id="relatedPost" data-width="100%"  data-placeholder="Choose ...">
                    @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ $type->id == $cinema->type ? 'selected' : ''}} >{{ $type->type_name }}</option>
                    @endforeach
               
                </select>
            </div>
			
			<!--<div class="form-group mb-2">-->
			<!--	<label>Cinema Description</label>-->
   <!--             <textarea id="editor" class="form-control" name="cinema_description">{!!$cinema->cinema_description!!}</textarea>-->

   <!--             @error('cinema_description')-->
   <!--                 <strong class="text-danger">{{ $message }}</strong>-->
   <!--             @enderror-->
			<!--</div>-->
			<div class="form-group mb-2">
				<label>Cinema Image</label>
				<input type="file" class="imageupload @error('cinema_image') is-invalid @enderror" name="cinema_image"
                data-default-file="{{asset($cinema->cinema_image)}}">
                @error('cinema_image')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
			
			  <div class="form-group mb-2">
                <label>Cinema link</label>
                <input type="text" class="form-control @error('cinema_link') is-invalid @enderror" name="cinema_link"
                value="{{ $cinema->cinema_link}}">
                @error('cinema_link')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            
			<div class="form-check mb-2">
                <input type="checkbox" class="form-check-input" {{ ($cinema->show_in_app == 1 ? 'checked':'') }}  name="show_in_app" value="1">
                <label class="form-check-label">Show in App</label>
            </div>
            
			<div class="form-check form-switch mb-2">
                <input type="checkbox" class="form-check-input" id="customSwitch1" name="cinema_status" value="1"
                {{ $cinema->cinema_status == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="customSwitch1">Publish</label>
            </div>
			<div class="text-center">
		        <button class="btn btn-primary" type="submit"> Update cinema </button>
		    </div>
		</form>
	</div>
</div>

<script type="text/javascript">

    ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
            editor.ui.view.editable.element.style.height = '300px';
    } )
    .catch( error => {
        console.error( error );
    } );

	$('.imageupload').dropify();
	
	$('#relatedPost').select2({
        maximumSelectionLength: 3
    });

</script>
@endsection