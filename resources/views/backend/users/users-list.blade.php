@extends('backend.layouts.app')
@section('content')
<style>
    #ncrd{
        position:relative;
    }
</style>
    <!--<audio id="chat-alert-sound" style="display: none">-->
    <!--    <source src="{{ asset('sound/facebook_chat.mp3') }}" />-->
    <!--</audio>-->
<link href="{{ asset('css/chat.css') }}" rel="stylesheet" type="text/css" />
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#InviteUser" href="javascript:;" href="{{ route('backend.create-users') }}">+ Add Client</a>
        </h4>
    </div>
</div>

<div class="row">
    <div class="col-12">
        @if(Session::has('success'))
        <div class="alert alert-success" style="text-align: center;">
            {{ Session::get('success') }}
        </div>
        @endif
        <div class="card" id="ncrd">
            <div class="card-body table-responsive">
                <div id="chat-overlay" class="row"></div>
                <table id="datatable" class="table table-bordered table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>AVATAR</th>
                            <th>USERNAME</th>
                            <th>ROLE</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($manageUsers as $user)
                        <tr>
                             <td> 
                             <img src="{{ url('/') }}/{{ $user->avatar }}" width="150" >
                             </td>
                            <td>
                                <div class="overflow-hidden">
                                    <div>
                                        <div class="text-truncate">
                                            {{ $user->name }}
                                        </div>
                                        <div class="text-truncate">
                                            <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td>{{ $user->role->name }}</td>

                            <td>
                                <a href="{{route('backend.edit-users',$user->id)}}" class="btn btn-sm btn-primary waves-effect waves-light"><i class="mdi mdi-square-edit-outline"></i></a>
                                <a href="{{route('backend.delete-users',$user->id) }}" id="delete" class="btn btn-sm btn-danger waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></a>
                                <a href="javascript:void(0);" class="chat-toggle" data-id="{{ $user->id }}"  data-chanel="{{ $user->chanel }}" data-user="{{ $user->name }}">Open chat</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> <!-- end row -->



<!-- Standard modal content -->
<div id="InviteUser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addcontact-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="user_form_submit">
                <div class="modal-header">
                    <h4 class="modal-title" id="addcontact-modalLabel">Add User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6 mb-2">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{old('username')}}">
                            <span class="text-danger" id="username"></span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}">
                            <span class="text-danger" id="email"></span>
                        </div>
                        
                        {{--<div class="col-md-6 mb-2">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone')}}">
                        </div>--}}

                        <div class="col-md-6 mb-2">
                            <label class="form-label">Role</label>
                            <select class="form-control @error('role') is-invalid @enderror" name="role" id="">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="role"></span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Password</label>
                            <input type="password" id="mypass" class="form-control @error('password') is-invalid @enderror password mb-2" name="password" value="{{old('password')}}">
                            <span class="text-danger" id="password"></span>
                            <input type="hidden" name="main_password" id="main_password">
                            <input type="checkbox" class="show_password"> Show Password
                            <button type="button" class="btn btn-dark generate_password">Genereate random password</button>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control @error('confirm_password') is-invalid @enderror password" name="password_confirmation" value="{{old('password_confirmation')}}">
                            <span class="text-danger" id="password_confirmation"></span>
                        </div>
                        <div class="col-md-6 mb-2">
                           <label class="form-label">Avatar</label>
                            <input type="file" class="dropify" name="avatar">  
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Contract Paper</label>
                            <input type="file" class="dropify" name="contract_paper">
                        </div>

                        <div class="col-md-6 mb-2">
                            <label class="form-label">Ammendment</label>
                            <input type="file" class="dropify" name="ammendment[]" multiple>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary user_submit">Add </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@include('backend.users.chat-box')
<input type="hidden" id="baseurl" value="{{ url('/') }}" />
<input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
<input type="hidden" id="pusher_app_key" value="{{ env('PUSHER_APP_KEY') }}" />
<input type="hidden" id="pusher_cluster" value="{{ env('PUSHER_APP_CLUSTER') }}" />
@endsection

@section('script')
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
  <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script src="{{ asset('js/chat.js') }}"></script>
<script>
    $('.dropify').dropify();

    $('.generate_password').on('click', function(){
        var randomstring = Math.random().toString(36).slice(-8);
        $('.password').val(randomstring);
    });
    $('.show_password').on('click', function(){
        // alert('hello');
        var type = $('.password').attr('type');
        if(type == 'password'){
            $('.password').attr('type', 'text');
        }else{
            $('.password').attr('type', 'password');
        }
    });
    
    $('#mypass').on('change',function(e){
        let pass = $(this).val();
        console.log(pass);
        $('#main_password').val(pass);
    })


    $('.user_submit').click(function(e) {
        e.preventDefault();
        
        var $fileUpload = $("#ammendmentImage");
        // if (parseInt($fileUpload.get(0).files.length)>3){
        //     alert("You can only upload a maximum of 3 ammendment files");
        //     return false;
        // }
        
        $('#first_name').text('');
        $('#last_name').text('');
        $('#email').text('');
        $('#role').text('');
        $('#avatar').text('');
        $('#office').text('');
        $('#password').text('');
        $('#password_confirmation').text('');
        var fromData = new FormData(document.getElementById("user_form_submit"));
        //fromData.append('main_password', $('#password').val());
        $.ajax({
            url: "{{route('backend.save-users')}}",
            type: "POST",
            data: fromData,
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response) {
                // console.log(response);
                $('#InviteUser').modal("hide");
                window.location.reload();
            },
            error: function(response) {
                //console.log(response);
                $('#username').text(response.responseJSON.errors.username);
                $('#email').text(response.responseJSON.errors.email);
                $('#role').text(response.responseJSON.errors.role);
                $('#password').text(response.responseJSON.errors.password);
                $('#avatar').text(response.responseJSON.errors.avatar);
                $('#password_confirmation').text(response.responseJSON.errors.password_confirmation);
            }
        });
    })

    //user delete-----------------
    //delete sweetalert
    $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        var Id = $(this).attr('href');

        swal({
                title: "Are you sure?",
                text: "You want to delete!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Successfully deleted!", {
                        icon: "success",
                    });

                    window.location.href = Id;

                } else {
                    swal("safe!");
                }

            });
    });

    //user inactive-----------------
    $(document).on('click', '#user_inactive', function(e) {
        e.preventDefault();
        var Id = $(this).attr('href');

        swal({
                title: "Are you sure?",
                text: "do you want to inactive!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Successfully inactive!", {
                        icon: "success",
                    });

                    window.location.href = Id;

                } else {
                    swal("safe!");
                }

            });
    });
</script>
@endsection