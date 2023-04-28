@extends('backend.layouts.app')
@section('title', 'Add Testimonial')
@section('content')
<div class="card">
    <div class="card-body">
        <form id="addTestimonial" action="{{route('backend.save-testimonial')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-2">
                <label>User Name</label>
                <input type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name"
                value="{{old('user_name')}}">
                
                @error('user_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
          	<div class="form-group mb-2">
                <label>User Designation</label>
                <input type="text" class="form-control @error('user_designation') is-invalid @enderror" name="user_designation"
                value="{{old('user_designation')}}">
                @error('user_designation')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label>User Comments</label>
                <textarea id="editor" name="user_comment"></textarea>
                @error('user_comment')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-check form-switch mb-2">
                <input type="checkbox" class="form-check-input" id="customSwitch1" name="user_status">
                <label class="form-check-label" for="customSwitch1">Publish</label>
            </div>
            <div class="text-center">
                <button class="btn btn-primary" type="submit"> Add Testimonial </button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">

    ClassicEditor.create(document.querySelector('#editor'))
    .then(editor => {
        editor.ui.view.editable.element.style.height = '300px';
    })
    .catch(error => {
        console.error(error);
    });

</script>
@endsection