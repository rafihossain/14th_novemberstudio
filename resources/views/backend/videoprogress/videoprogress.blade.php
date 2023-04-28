@extends('backend.layouts.app')

@section('content')
 <!--- <div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a class="btn btn-primary" href="{{ url('/addvideoprogress') }}">+ Add Video Progress</a>
        </h4>
    </div>
</div> -->

<div class="row">
    <div class="col-12">
        
        <div class="card">
            <div class="card-body table-responsive">
                <table id="datatable" class="table table-bordered table-bordered dt-responsive nowrap">
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
                         <td>{{ @$vp->getusers->name }}</td>
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
    </div>
</div> <!-- end row -->


@endsection
@section('script')
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endsection