@extends('backend.layouts.app')
@section('title', 'Add Faq')
@section('content')
<div class="card">
	<div class="card-body">
		<form id="formfaq" action="{{route('backend.faq-save')}}" method="POST" enctype="multipart/form-data">
            @csrf
			<div class="form-group mb-2">
				<label>Faq Qustion</label>
				<input type="text" class="form-control @error('faq_question') is-invalid @enderror" name="faq_question"
				value="{{old('faq_question')}}">
                @error('faq_qus')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>
			
			<div class="form-group mb-2">
				<label>Faq Answer</label>
				<div id="editor" style="height: 300px;"></div>
                <textarea name="faq_answare" style="display:none" id="hiddenArea"></textarea>

                @error('faq_ans')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
			</div>

			<div class="text-center">
		        <button class="btn btn-primary" type="submit"> Add Faq </button>
		    </div>
		</form>
	</div>
</div>

<script>
	$(document).ready(function() {
        $("#formfaq").on("submit", function() {
            $("#hiddenArea").val($(".ql-editor").html());
        })
    });

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