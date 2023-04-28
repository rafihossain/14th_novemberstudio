@extends('backend.layouts.app')
@section('title', 'List Section')
@section('content')
<div class="text-end mb-3">
    <a href="{{ route('backend.add-section') }}" class="btn btn-primary "><i class="mdi mdi-plus"></i>Add Section</a>
</div>
@if(session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif
<div class="card">
    <div class="card-body">
        <h4 class="mt-0 header-title"> All Section</h4>

        <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Publish date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach($section as $sections)  
                <tr>
                    <td>{{$sections['section_name']}}</td>
                    <td><?php echo date('d/m/y',strtotime($sections['created_at']));?></td>
                    <td>
                        <a href="{{route('backend.section_edit',$sections['id'])}}" class="btn btn-sm btn-success"><i class="mdi mdi-file-edit-outline"></i></a>
                      <a href="{{route('backend.delete-section',$sections['id']) }}" id="delete" class="btn btn-sm btn-danger waves-effect waves-light">
                                    <i class="mdi mdi-trash-can-outline"></i>
                                </a>
                    
                    
                    </td>
                </tr>
             @endforeach    
            </tbody>
        </table>
    </div>
</div>
@endsection