@extends('backend.layouts.app')
@section('title', 'List Page')
@section('content') 
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif

    @if(session()->has('delete'))
    <div class="alert alert-danger">
        {{ session()->get('delete') }}
    </div>
    @endif
    <div class="text-end mb-3">
        <a href="{{ route('backend.addpage') }}" class="btn btn-primary "><i class="mdi mdi-plus"></i>Add page</a>
    </div>
    <div class="card">
        <div class="card-body">
            
  
            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Publish date</th>
                    <th>Views</th> 
                    <th>Action</th>
                </tr>
                </thead>


                <tbody>
                   @foreach($all_page as $all_pages) 
                   <?php 
                   $date=date_create($all_pages['created_at']);
                   $publish_date=date_format($date,"d/m//Y");
                   ?>
                     <tr>
                        <td>{{$all_pages['page_name']}}</td>
                        <td>{{$publish_date}}</td> 
                        <td>61</td> 
                        <td>
                            <a href="#" class="btn btn-sm btn-primary"><i class="mdi mdi-eye-outline"></i></a>
                            <a href="{{route('backend.page_edit',$all_pages['id'])}}" class="btn btn-sm btn-success"><i class="mdi mdi-file-edit-outline"></i></a>
                            <a href="{{route('backend.page_delete',$all_pages['id'])}}" id="delete" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can-outline"></i></a>
                        </td>
                    </tr> 
                 @endforeach   
                </tbody>
            </table>
        </div>
    </div> 
@endsection