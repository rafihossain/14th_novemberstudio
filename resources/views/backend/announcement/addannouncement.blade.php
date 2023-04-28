@extends('backend.layouts.app')

@section('content')
 <div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a class="btn btn-primary" href="{{ route('backend.announcement-list') }}"><i class="fe-chevron-left"></i> Announcement List</a>
        </h4>
    </div>
</div>

 
  <form action="{{route('backend.announcement-save')}}" method="POST">
    <div class="card"> 
        <div class="card-body"> 
        	 
                @csrf
                <div class="row">
              		<div class="col-md-12 mb-2">
                        <label class="form-label">Announcement Title</label>
                        <input type="text" class="form-control" name="title"> 
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="form-label">User</label>
                        
                        <select class="form-control " id="user_id" name="user_id">
                        	<option value="">Choose User</option>
                            @foreach ($users as $user)
                            <option value="{{ $user['id'] }}">{{ $user['name'] }}   </option>
                           @endforeach    
                        
                        </select> 
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="form-label">Description </label> 
                        <textarea class="form-control" id="editor1" name="description"></textarea>
                    </div>
                     <div class="col-md-12 mb-2">
                        <label class="form-label">Date</label> 
                        <input type="date" class="form-control" name="an_date">
                        @error('an_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>  
                </div>
        	<div>
		        <button class="btn btn-primary" type="submit"> Add Announcement</button>
		    </div>
        </div>
    </div> 
</form>
 

@endsection
@section('script')
<!--CK editor-->
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
 <script type="text/javascript">
     document.addEventListener("DOMContentLoaded", (event) => {
      $('#user_id').select2({
      placeholder: 'Select an option'
    });
  });

 
 	ClassicEditor.create( document.querySelector( '#editor1' ) )
		.then( editor => {
			window.editor1 = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} ); 
 </script>
@endsection