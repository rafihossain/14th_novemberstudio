@extends('backend.layouts.app')
@section('title', 'Edit Blog Category')
@section('content')
<div class="card">
	<div class="card-body">
		<form id="formCategory" action="{{route('backend.update-category')}}" method="POST" enctype="multipart/form-data">
            @csrf
			<div class="form-group mb-2">
				<label>Category Name</label>
				<input type="hidden" name="id" value="{{ $editCategory->id }}">
				<input type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name"
				value="{{ $editCategory->category_name }}">
                @error('category_name')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
            <div class="form-group mb-2">
				<label>Slug Url</label>
				<input type="text" class="form-control @error('category_slug') is-invalid @enderror" name="category_slug"
                value="{{$editCategory->category_slug}}">
                @error('category_slug')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
			<div class="form-group mb-2">
				<label>Meta Title</label>
				<input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title"
				value="{{ $editCategory->meta_title }}">
                @error('meta_title')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
			<div class="form-group mb-2">
				<label>Meta Keywords</label>
				<input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords"
				value="{{ $editCategory->meta_keywords }}">
                @error('meta_keywords')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
			<div class="form-group mb-2">
				<label>Meta Description</label>
				<input type="text" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" value="{{ $editCategory->meta_description }}">
                @error('meta_description')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>

			<div class="form-group mb-2">
				<label>Category Description</label>
				<div id="editor" style="height: 300px;">{!! $editCategory->category_description !!}</div>
                <textarea name="category_description" style="display:none" id="hiddenArea"></textarea>

                @error('category_description')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
    <div class="form-group mb-2">
            <label>Image</label>
            <input type="file" class="imageupload @error('image') is-invalid @enderror" name="image"  data-default-file="{{asset($editCategory->image)}}">
            @error('image')
            <strong class="text-danger">{{ $message }}</strong>
            @enderror
        </div>
               <div class="form-group mb-2">
            <label>Image icon</label>
            <input type="file" class="imageupload @error('icon') is-invalid @enderror" name="icon" data-default-file="{{asset($editCategory->icon)}}">
            @error('icon')
            <strong class="text-danger">{{ $message }}</strong>
            @enderror
        </div>
            
			<div class="text-center">
		        <button class="btn btn-primary" type="submit"> Update Category </button>
		    </div>
		</form>
	</div>
</div>

<script>
	$(document).ready(function() {
        $("#formCategory").on("submit", function() {
            $("#hiddenArea").val($(".ql-editor").html());
        })
    });
	$('.imageupload').dropify();
	var quill = new Quill("#editor", {
        theme: "snow",
        modules: {
            toolbar: [
                [{
                    font: []
                }, {
                    size: []
                }],
                ["bold", "italic", "underline", "strike"],
                [{
                    color: []
                }, {
                    background: []
                }],
                [{
                    script: "super"
                }, {
                    script: "sub"
                }],
                [{
                    header: [!1, 1, 2, 3, 4, 5, 6]
                }, "blockquote", "code-block"],
                [{
                    list: "ordered"
                }, {
                    list: "bullet"
                }, {
                    indent: "-1"
                }, {
                    indent: "+1"
                }],
                ["direction", {
                    align: []
                }],
                ["link", "image", "video"],
                ["clean"]
            ]
        }
    })
</script>
@endsection