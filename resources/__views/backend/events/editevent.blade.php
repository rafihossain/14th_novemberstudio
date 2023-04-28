@extends('backend.layouts.app')

@section('content')
 <div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a class="btn btn-primary" href="{{ route('backend.edit-users',['id'=> $event->user_id]) }}"><i class="fe-chevron-left"></i> Back to Client profile</a>
            <a class="btn btn-primary" href="{{ route('backend.event-list') }}"><i class="fe-chevron-left"></i> Events List</a>
        </h4>
    </div>
</div>

<div class="row">
    <div class="col-12">
        
        <div class="card">
            <div class="card-body ">
              <form action="{{route('backend.event-update')}}" method="POST">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">
              	<div class="row">
              		<div class="col-md-12 mb-2">
                        <label class="form-label">Event Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $event->event_title }}"> 
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">User</label>
                        
                        <select class="form-control" id="user_id" name="user_id">
                        	<option value="">Choose User</option>
                        @foreach ($users as $user)
                        <option value="{{ $user['id'] }}"   {{ $user['id'] == $event->user_id ? 'selected':''  }}>{{ $user['name'] }} </option>
                        @endforeach    
                        </select> 
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Event Date </label>
                        <input type="date" class="form-control" name="date_time" value="{{ $event->event_date }}">
                        @error('date_time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Event Start Time</label>
                        <input type="time" class="form-control " name="start_time" value="{{ $event->start_time }}">
                        @error('start_time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Event End Time</label>
                        <input type="time" class="form-control " name="end_time" value="{{ $event->end_time }}">
                        @error('end_time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Event Hours</label>
                            <input type="number" class="form-control " name="event_hour" value="{{ $event->event_hour }}">
                            @error('event_hour')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    
                    
                    <div class="col-md-6 mb-2">
                        <label class="form-label">How many video graphers </label>
                        <input type="text" class="form-control" name="video_graphers" value="{{ $event->count_video }}"> 
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Event Location </label>
                        <input type="text" class="form-control" name="location" value="{{ $event->locations }}"> 
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="form-label">Special Notes </label>
                        <textarea class="form-control" id="ckeditor" name="special_notes">{!! $event->notes !!}</textarea>
                    </div>
              	</div>
              	<div>
			        <button class="btn btn-primary" type="submit"> Update Event </button>
			    </div>
              </form>
            </div>
        </div>
    </div>
</div> <!-- end row -->


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
 	 ClassicEditor
        .create( document.querySelector( '#ckeditor' ) )
        .then( editor => {
            editor.ui.view.editable.element.style.height = '160px';
        } )
        .catch( error => {
            console.error( error );
        } );
 </script>
@endsection