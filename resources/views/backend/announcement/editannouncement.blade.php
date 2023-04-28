@extends('backend.layouts.app')

@section('content')
 <div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a class="btn btn-primary" href="{{ route('backend.announcement-list') }}"><i class="fe-chevron-left"></i> Payment List</a>
        </h4>
    </div>
</div>

 
  <form action="{{route('backend.announcement-update')}}" method="POST">
    <div class="card"> 
        <div class="card-body"> 
        	 
                @csrf
                <input type="hidden" name="announcement_id" value="{{ $announcement->id }}">
          	<div class="row"> 
          		<div class="col-md-12 mb-2">
                        <label class="form-label">Announcement Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $announcement->title }}"> 
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
          		<div class="col-md-12 mb-2">
                    <label class="form-label">User </label> 
                    <input type="text" class="form-control" value="{{ $announcement->getusers->name}}" readonly>
                </div>
                <div class="col-md-12 mb-2">
                        <label class="form-label">Description </label> 
                        <textarea class="form-control" id="editor1" name="description">{{ $announcement->description }}</textarea>
                    </div>
                     <div class="col-md-12 mb-2">
                        <label class="form-label">Date</label> 
                        <input type="date" class="form-control" name="an_date" value="{{ $announcement->an_date }}">
                        @error('an_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> 
                
        	<br>
        	<div>
		        <button class="btn btn-primary" type="submit"> Update Announcement</button>
		    </div>
        </div>
    </div> 
</form>
 

@endsection
@section('script')
<!--CK editor-->
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
 <script type="text/javascript">
 	ClassicEditor.create( document.querySelector( '#editor1' ) )
		.then( editor => {
			window.editor1 = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} ); 
//	$(".dueamounts").show();
	$( "body" ).delegate( "#customSwitch1", "click", function() {
	    if($(this).is(":checked")) {
	        $(".dueamounts").hide(300);
	    } else {
	        $(".dueamounts").show(200);
	    }
	});
 </script>
@endsection