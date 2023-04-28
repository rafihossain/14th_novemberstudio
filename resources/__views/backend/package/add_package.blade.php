@extends('backend.layouts.app')
@section('title', 'Add Blog package')
@section('content')
<div class="card">
	<div class="card-body">
		<form id="formpackage" action="{{route('backend.save-package')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-2">
				<label>Package Category</label>
                <select name="package_category_id" class="form-control">
                    <option value="">Select Packages</option>
                    @foreach($package_categories as $package_category)
                        <option value="{{ $package_category->id }}">{{ $package_category->package_name }}</option>
                    @endforeach
                </select>
                @error('package_category_id')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
			<div class="form-group mb-2">
				<label>Package Name</label>
				<input type="text" class="form-control @error('package_name') is-invalid @enderror" name="package_name"
				value="{{old('package_name')}}">
                @error('package_name')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
		
			<div class="form-group mb-2">
				<label>Package Description</label>
				<div id="editor" style="height: 300px;"></div>
                <textarea name="package_description" style="display:none" id="hiddenArea"></textarea>

                @error('package_description')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
            <div class="form-group mb-2">
                <label>Package Image</label>
                <input type="file" class="imageupload @error('package_image') is-invalid @enderror" name="package_image">
                @error('package_image')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
			<div class="text-center">
		        <button class="btn btn-primary" type="submit"> Add package </button>
		    </div>
		</form>
	</div>
</div>

<script>
	$(document).ready(function() {
        $("#formpackage").on("submit", function() {
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