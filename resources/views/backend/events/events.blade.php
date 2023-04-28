@extends('backend.layouts.app')

@section('content')
 <div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a class="btn btn-primary" href="{{ route('backend.event-add') }}">+ Add Event</a>
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
        
        <div class="card">
            <div class="card-body table-responsive">
                <table id="datatable" class="table table-bordered table-bordered dt-responsive nowrap">
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
        </div>
    </div>
</div> <!-- end row -->


@endsection

@section('script')
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

<script>
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
</script>
@endsection