@extends('backend.layouts.app')

@section('content')
 <div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
          <a class="btn btn-primary" href="{{ route('backend.edit-users',['id'=> $videoprogress->getusers->id]) }}"><i class="fe-chevron-left"></i> Back to Client profile</a>
            <a class="btn btn-primary" href="{{ route('backend.videoprogress-list')  }}"><i class="fe-chevron-left"></i> Video Progress List</a>
        </h4>
    </div>
</div>

 
<form action="{{route('backend.videoprogress-update')}}" method="POST">
      @csrf
    <div class="card">
        <div class="card-body"> 
          	<div class="row"> 
                <div class="col-md-12 mb-2">
                    <label class="form-label">User </label>
                    <input type="text" class="form-control" value="{{ $videoprogress->getusers->name }}" readonly>
                    <input type="hidden" name="videoprogress_id" value="{{ $videoprogress->id }}">
                </div>  
        	</div>
        </div>
    </div>
    <div class="card"> 
        <div class="card-body"> 
        	<h4 class="card-title">Higlight Song</h4>
          	<div class="row"> 
                <div class="col-md-12 mb-2">
                    <label class="form-label">Description </label> 
                    <textarea class="form-control" name="higlight_song_links">{{ $videoprogress->higlight_song_links }}</textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label class="form-label">Status </label> 
                    <select class="form-control" name="higlight_song_status">
                        <option {{ ($videoprogress->higlight_song_status == 2 ? 'selected':'') }}  value="2">Set status</option>
                        <option  {{ ($videoprogress->higlight_song_status == 0 ? 'selected':'') }} value="0">Due</option>
                        <option  {{ ($videoprogress->higlight_song_status == 1 ? 'selected':'') }} value="1">provided</option> 
                    </select> 
                </div>  
                
              <div class="col-md-12 mb-2">
                    <label class="form-label">Notes </label> 
                    <textarea class="form-control"  name="higlight_song_note">{{ $videoprogress->higlight_song_note }}</textarea>
                </div>    
                
        	</div>
        </div>
    </div>
    <div class="card"> 
        <div class="card-body"> 
        	<h4 class="card-title">Long Version Song</h4>
          	<div class="row"> 
                <div class="col-md-12 mb-2">
                    <label class="form-label">Description </label> 
                    <textarea class="form-control"  name="lg_ver_song_links">{{ $videoprogress->lg_ver_song_links }}</textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label class="form-label">Status </label> 
                    <select class="form-control" name="lg_ver_song_status">
                      <option value="2">Set status</option>
                     <option  {{ ($videoprogress->lg_ver_song_status == 0 ? 'selected':'') }} value="0">Due</option>
                        <option  {{ ($videoprogress->lg_ver_song_status == 1 ? 'selected':'') }} value="1">provided</option> 
                    </select> 
                </div>  
                <div class="col-md-12 mb-2">
                    <label class="form-label">Notes </label> 
                    <textarea class="form-control"  name="lg_ver_song_note">{{ $videoprogress->lg_ver_song_note }}</textarea>
                </div>
        	</div>
        </div>
    </div>
    <div class="card"> 
        <div class="card-body"> 
        	<h4 class="card-title">Photo for usp cover</h4>
          	<div class="row"> 
                <div class="col-md-12 mb-2">
                    <label class="form-label">Description </label> 
                    <textarea class="form-control"  name="ph_for_usp_cove_links">{{ $videoprogress->ph_for_usp_cove_links }}</textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label class="form-label">Status </label> 
                    <select class="form-control" name="ph_for_usp_cove_status">
                      <option {{ ($videoprogress->ph_for_usp_cove_status == 2 ? 'selected':'') }} value="2">Set status</option>
                      <option  {{ ($videoprogress->ph_for_usp_cove_status == 0 ? 'selected':'') }} value="0">Due</option>
                      <option  {{ ($videoprogress->ph_for_usp_cove_status == 1 ? 'selected':'') }} value="1">provided</option> 
                    </select> 
                </div>  
                <div class="col-md-12 mb-2">
                    <label class="form-label">Notes </label> 
                    <textarea class="form-control"  name="ph_for_usp_cove_note">{{ $videoprogress->ph_for_usp_cove_note }}</textarea>
                </div>
        	</div>
        </div>
    </div>
    <div class="card"> 
        <div class="card-body"> 
        	<h4 class="card-title">Video Progress</h4>
          	<div class="row"> 
                <div class="col-md-12 mb-2">
                    <label class="form-label">Status </label> 
                    <select class="form-control" name="vid_progress_status">
                      <option  {{ ($videoprogress->vid_progress_status == 0 ? 'selected':'') }} value="0">Not Statred</option>
                      <option  {{ ($videoprogress->vid_progress_status == 1 ? 'selected':'') }} value="1">In progress </option>
                      <option  {{ ($videoprogress->vid_progress_status == 2 ? 'selected':'') }} value="2">Completed</option> 
                    </select> 
                </div>  
        	</div>
        <div class="col-md-12 mb-2">
        <label class="form-label">Notes </label> 
        <textarea class="form-control" name="vid_progress_note">{{ $videoprogress->vid_progress_note }}</textarea>
        </div>
          	<div class="row"> 
                <div class="col-md-12 mb-2">
                    <label class="form-label">Balance Date </label> 
                     <input type="date" class="form-control" name="balance_date" value="{{ $videoprogress->balance_date }}">
                </div>  
        	</div>
          	<div class="row"> 
                <div class="col-md-12 mb-2">
                    <label class="form-label">Expected Date </label> 
                    <input type="date" class="form-control" name="expected_date" value="{{ $videoprogress->expected_date }}">
                </div>  
        	</div>	
        	
        	
        	
        </div>
    </div>
    
     <div class="card"> 
        <div class="card-body"> 
        	<h4 class="card-title">Correction Request</h4>
          	<div class="row"> 
                <div class="col-md-12 mb-2">
                    <label class="form-label">Status </label> 
                    <select class="form-control" name="correction_request">
                      <option {{ ($videoprogress->correction_request == 2 ? 'selected':'') }} value="2">Set status</option>
                      <option  {{ ($videoprogress->correction_request == 0 ? 'selected':'') }} value="0">No Request</option>
                      <option  {{ ($videoprogress->correction_request == 1 ? 'selected':'') }} value="1">Received</option>
                   </select> 
                </div>  
        	</div>

          	<div class="row"> 
                <div class="col-md-12 mb-2">
                    <label class="form-label">Notes </label> 
                    <textarea class="form-control"  name="correction_note">{{ $videoprogress->correction_note }}</textarea>
                </div>  
        	</div>	
        	
        	
        	
        </div>
    </div> 
    
    <div class="card"> 
        <div class="card-body">  
        	<div>
		        <button class="btn btn-primary" type="submit">update Progress</button>
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


	ClassicEditor.create( document.querySelector( '#editor7' ) )
		.then( editor => {
			window.editor7 = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );

	ClassicEditor.create( document.querySelector( '#editor8' ) )
		.then( editor => {
			window.editor8 = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );

	ClassicEditor.create( document.querySelector( '#editor2' ) )
		.then( editor => {
			window.editor2 = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
		ClassicEditor.create( document.querySelector( '#editor3' ) )
		.then( editor => {
			window.editor2 = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
		ClassicEditor.create( document.querySelector( '#editor4' ) )
		.then( editor => {
			window.editor2 = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
				ClassicEditor.create( document.querySelector( '#editor5' ) )
		.then( editor => {
			window.editor2 = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
 </script>
@endsection