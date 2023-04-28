@extends('backend.layouts.app')
@section('title', 'Edit Testimonial')
@section('content')
<div class="card">
    <div class="card-body">
        <form id="editTestimonial" action="{{route('backend.update-testimonial')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$testimonial->id}}">

            <div class="form-group mb-2">
                <label>User Name</label>
                <input type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name"
                value="{{$testimonial->user_name}}">
                @error('user_name')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
          	<div class="form-group mb-2">
                <label>User Designation</label>
                <input type="text" class="form-control @error('user_designation') is-invalid @enderror" name="user_designation"
                value="{{$testimonial->user_designation}}">
                @error('user_designation')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label>User Comments</label>
                <textarea name="user_comment" id="editor">{!! $testimonial->user_comment !!}</textarea>

                @error('user_comment')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            <div class="form-check form-switch mb-2">
                <input type="checkbox" class="form-check-input" id="customSwitch1" name="user_status"
                {{ $testimonial->user_status == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="customSwitch1">Publish</label>
            </div>
            <div class="text-center">
                <button class="btn btn-primary" type="submit"> Update Testimonial </button>
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