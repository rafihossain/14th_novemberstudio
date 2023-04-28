@extends('backend.layouts.app')
@section('content')

@if(Session::has('do_not_match'))
    <div class="alert alert-danger" style="text-align: center;">
        {{ Session::get('do_not_match') }}
    </div>
@endif


<div class="card">
	<div class="card-body">
	
             <ul class="nav nav-tabs">
            
                <li class="nav-item">
                    <a href="#profile" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                        Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#userevents" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                        Events
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#uservideoprogress" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                        Video Progress
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#userpayment" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                        Payment
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#announcement" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                        Announcement
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="profile"> 
                    <form id="editformInput" action="{{route('backend.update-users')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                            value="{{ $user->name }}">
                            @error('username')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ $user->email }}">
                            @error('email')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Role <span class="text-danger">*</span></label>
                    
                            <select class="form-control @error('role') is-invalid @enderror" name="role" id="">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{$user->role->name == $role->name ? 'selected' : '' }}
                                        >{{ $role->name }}</option>
                                @endforeach
                            </select>
                    
                            @error('role')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Password</label>
                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password">
                            @error('password')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>    
                        <div class="col-md-6 mb-2">
                            <label>Confirm Password</label>
                            <input type="password" id="confirm_password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                            @error('password_confirmation')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                        <label class="form-label">Avatar</label>
                        <input type="file" class="imageupload @error('avatar') is-invalid @enderror" name="avatar"
                        data-default-file="{{asset( $user->avatar)}}">
                        @error('avatar')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        </div>
                      
                       <div class="col-12">
                           <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Contract Paper</label>
                                  @if(isset($user->contract_paper))
                                    <input type="file" class="dropify" name="contract_paper" data-default-file="{{ asset($user->contract_paper) }}">
                                  @else
                                    <input type="file" class="dropify" name="contract_paper">
                                  @endif
                                  
                                </div>
                                <div class="col-md-6 mb-2">
                                    
                                     <label class="form-label">Ammendment</label>
                                    <input type="file" class="dropify" name="ammendment[]" multiple>
                                    <div class="mt-2">
                                         @if($user->ammendment_image)
                                            <input type="hidden" class="get_ammendment_id" name="ammendment_id">
                                            @foreach($user->ammendment_image as $key => $ammendment)
                                            <div class="mb-3 overflow-hidden"  id="ammendment_{{$key}}">
                                                <div style="position:relative;" class="px-2 text-start">
                                                    <a href="#" data-delete="{{$key}}" data-ammendment="{{ $ammendment->id }}" class="delete" style="left:0; right:0;">
                                                        <span class="btn btn-primary float-end">&Cross;</span>
                                                    </a>
                            
                                                    <a href="{{ asset($ammendment->name) }}" >{{$ammendment->name}}</a>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div> 
                                </div>
                           </div>
                       </div>
                    </div> 
                    <div class="  mt-4">
                        <button class="btn btn-primary" type="submit" id="submit"> Save </button>
                    </div> 
                           
                    </form>
                </div>
                <div class="tab-pane" id="userevents">
                    <h4 class="m-0 mb-4 header-title text-end ">
                        <a class="btn btn-primary add_events" href="{{ route('backend.event-add')  }}">+ Add Event</a>
                    </h4>
                 
                    <table id="datatable" class="table table-bordered table-bordered dt-responsive nowrap w-100">
                        <!--<table id="datatable" class="table table-bordered table-bordered dt-responsive nowrap">-->
                    <thead>
                        <tr>
                            <th>Event Title</th>
                            <th> User Name </th>
                            <th> Event Date  </th>
                            <th> Event Location </th>
                            <th> How many video </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        <tr>
                        	<td>{{ $event->event_title }}</td>
                            <td>{{ $event->getusers->name }}</td>
                            <td>{{ $event->event_date }}</td>
                            <td>{{ $event->locations }}</td>
                            <td>{{ $event->count_video }}</td>
                            <td>
                                <a href="{{route('backend.event-edit',$event->id)}}" class="btn btn-sm btn-primary waves-effect waves-light">
                                    <i class="mdi mdi-square-edit-outline"></i>
                                </a>
                                <a href="{{route('backend.event-delete',$event->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect waves-light">
                                    <i class="mdi mdi-trash-can-outline"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <div class="tab-pane" id="uservideoprogress">
                    <div class="">
                         <table id="video_datatable" class="table table-bordered table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>User Name </th>
                            <th> Higlight Song </th>
                            <th>Long Version Song  </th>
                            <th> Photo for usp cover </th>
                            <th> Video Progress </th>
                            <th> Expected Delivery </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($videoprogresss as $vp)
                        <tr>
                         <td>{{ $user->name }}</td>
                          <td>
                              @if($vp->higlight_song_status == 0)
                            <span class="badge bg-danger">Due</span>
                             @elseif($vp->higlight_song_status == 2)
                             <span class="badge bg-danger">Set Status</span>
                            @else
                            <span class="badge bg-success">Provided</span>
                            <div> {{ strip_tags($vp->higlight_song_links) }}</div>
                            @endif
                            </td>
                            <td>
                             @if($vp->lg_ver_song_status == 0)
                            <span class="badge bg-danger">Due</span>
                                 @elseif($vp->lg_ver_song_status == 2)
                             <span class="badge bg-danger">Set Status</span>
                            @else
                            <span class="badge bg-success">Provided</span>
                            <div> {{ strip_tags($vp->lg_ver_song_links) }}</div>
                            <div>{{ strip_tags($vp->lg_ver_song_note) }}</div>
                            @endif
                            </td>
                            <td> 
                                @if($vp->ph_for_usp_cove_status == 0)
                                <span class="badge bg-danger">Due</span>
                                @elseif($vp->ph_for_usp_cove_status == 2)
                                <span class="badge bg-danger">Set Status</span>
                            @else
                            <span class="badge bg-success">Provided</span>
                            <div>{{ strip_tags($vp->ph_for_usp_cove_links) }}</div>
                            <div>{{ strip_tags($vp->ph_for_usp_cove_note) }}</div>
                          
                            @endif
                            </td>
                            <td>
                                @if($vp->vid_progress_status == 0)
                                <span class="badge bg-danger">Not Started</span>
                                @elseif($vp->ph_for_usp_cove_status == 2)
                                <span class="badge bg-danger">Set Status</span>
                                @elseif($vp->vid_progress_status == 1)
                                <span class="badge bg-danger"> In progress </span>
                                @else
                                <span class="badge bg-sucess">Complete</span>
                                @endif
                            </td>
                            <td>
                              {{ strip_tags($vp->expected_date ) }}
                            </td>
                            <td>
                                <a href="{{ route('backend.videoprogress-edit',$vp->id) }}" class="btn btn-sm btn-primary waves-effect waves-light"><i class="mdi mdi-square-edit-outline"></i></a>
                            </td>
                        </tr>

                        
                       @endforeach
                    </tbody>
                </table>
                    </div>
                </div>
                <div class="tab-pane" id="userpayment">
                  
                    <table id="datatable_payment" class="table table-bordered table-bordered dt-responsive nowrap w-100">
                       <thead>
                        <tr>
                            <th>User Name </th>
                            <th>Deposit Amount </th>
                            <th>Balance Due</th>
                            <th>Next Payment</th>
                            <th>Next Payment Amount </th>
                            <th>Notes </th>
                             <th>Status </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                        <td>{{ $payment->getusers->name }}</td>
                        <td>${{ $payment->deposit_amount }}</td>
                        <td>${{ $payment->due_balance }}</td>
                        <td>{{ $payment->next_payment }}</td>
                        <td>${{ $payment->next_paymet_amount }}</td>
                        <td>{{ strip_tags($payment->notes) }}</td>
                        <td><span class="badge bg-info">{{ ($payment->status == 0 ? 'Due': 'Paid' ) }}</span></td>
                         
                            <td> 
                                <a href="{{ route('backend.payment-edit', $payment->id) }}" class="btn btn-sm btn-primary waves-effect waves-light"><i class="mdi mdi-square-edit-outline"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                
               <div class="tab-pane" id="announcement">

                     <table id="announcement_datatable" class="table table-bordered table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>User Name </th>
                            <th>Title </th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($announcements as $announcement)
                            <tr>
                            <td>{{ $announcement->getusers->name }}</td>
                            <td>{{ $announcement->title }}</td>
                            <td>{{ $announcement->description }}</td>
                            <td>{{ $announcement->an_date }}</td>
                            <td> 
                                <a href="{{ route('backend.announcement-edit', $announcement->id) }}" class="btn btn-sm btn-primary waves-effect waves-light"><i class="mdi mdi-square-edit-outline"></i></a>
                                <a href="{{ route('backend.announcement-delete', $announcement->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect waves-light">
                                    <i class="mdi mdi-trash-can-outline"></i>
                                </a>
                                
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                   
                   
               </div>  
                
            </div>
    
	</div>
</div> 


@endsection

@section('script')
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
<script>
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust()
            .responsive.recalc();
    });
    $("#video_datatable").DataTable();
    $("#announcement_datatable").DataTable();
    $("#datatable_payment").DataTable();
    $( '.add_events_form' ).hide(); 
    $( '.add_videoprogress_form' ).hide(); 
    $( '.add_Payment_form' ).hide(); 
	$('.imageupload').dropify();
    $('.dropify').dropify();

    var arrayId = [];
    $('.set_ammendment_id').on('change', function(){
        arrayId.push($(this).data('id'));
        $('.get_ammendment_id').val(arrayId.toString());
    });

    $('.delete').click(function(e) {
        e.preventDefault();
        var deleteKey = $(this).data('delete');
        var deleteId = $(this).data('ammendment');
        jQuery.ajax({
            type: 'post',
            url: "{{route('backend.delete_ammendment_image')}}",
            data: {
                delete_id: deleteId,
                _token : "{{csrf_token()}}"
            },
            success: function(data) {
                $('#ammendment_' + deleteKey).remove();
                location.reload();
            }
        });
    });
 ClassicEditor.create( document.querySelector( '#editor1' ) )
        .then( editor => {
            window.editor1 = editor;
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
    $(".dueamounts").show();
    $( "body" ).delegate( "#customSwitch1", "click", function() {
        if($(this).is(":checked")) {
            $(".dueamounts").hide(300);
        } else {
            $(".dueamounts").show(200);
        }
    });

</script>
@endsection