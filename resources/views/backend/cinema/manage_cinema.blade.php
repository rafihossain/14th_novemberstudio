@extends('backend.layouts.app')
@section('title', 'List Cinema')
@section('content')
<div class="text-end mb-3">
    <a href="{{ route('backend.add-cinema') }}" class="btn btn-primary "><i class="mdi mdi-plus"></i>Add Cinema</a>
</div>

@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body">
        
        <div class="col-md-12 mb-3">
          <div class="row">
            <div class="col-md-6">
                <div class="category-filter">
                  <label for="">Category Filter</label>
                  <select id="category" class="form-control">
                    <option value="">Show All</option>
                    @foreach($cinemaCategories as $category)
                        <option value="@if(!empty($category)){{ $category->category_name }}@endif">
                            @if(!empty($category)){{ $category->category_name }}@endif</option>
                    @endforeach
                  </select>
                </div>
            </div>
          </div>
        </div>
        
		<table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
            <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th> 
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
                <?php $i = 1; ?>
                @foreach($cinemas as $cinema)
                <tr>
                    <td>
                    	<img src="{{ asset($cinema->cinema_image) }}" alt="" height="42" class="img-fluid avatar-lg rounded">
                    </td>
                    <td class="text-wrap">{{$cinema->cinema_title}}</td>
                    <td><span class="badge bg-primary rounded-pill">{{$cinema->category->category_name}}</span></td>
                    @if($cinema->cinema_status == 1)
                    <td><span class="badge bg-success rounded-pill">Publish</span></td> 
                    @else
                    <td><span class="badge bg-danger rounded-pill">Unpublish</span></td> 
                    @endif
                    <td>
                        @if($cinema->cinema_status == 1)
                            <a href="{{ route('backend.unpublished-cinema', ['id'=> $cinema->id ]) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-arrow-up"></i>
                            </a>
                        @else
                            <a href="{{ route('backend.published-cinema', ['id'=> $cinema->id ]) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-arrow-down"></i>
                            </a>
                        @endif
              
                        <a href="{{ route('backend.edit-cinema', $cinema->id) }}" class="btn btn-sm btn-success">
                            <i class="mdi mdi-file-edit-outline"></i>
                        </a>
                        @if((session()->get('user_type') == '1') || (session()->get('user_type') == '2')|| (session()->get('user_type') == '3'))
                        <a href="{{ route('backend.delete-cinema', $cinema->id) }}" id="delete" class="btn btn-sm btn-danger">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </a>
                        @endif
                    </td>
                </tr> 
                <?php $i++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(function() {

        $("#datatable").dataTable({
            "searching": true
        });
        var table = $('#datatable').DataTable();

        $("#datatable_filter.category-filter").append($("#category"));

        // $("#datatable_filter.dataTables_filter").append($("#category"));

        var categoryIndex = 0;
        $("#datatable th").each(function(i) {
            console.log($($(this)).html());
            if ($($(this)).html() == "Category") {
                categoryIndex = i;
                return true;
            }
        });

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var categoryItem = $('#category').val();

                if (categoryItem != '') {
                    var category = data[categoryIndex];
                    if (categoryItem === "" || category.includes(categoryItem)) {
                        return true;
                    }
                } else {
                    return true;
                }
            }
        );


        $("#category").change(function(e) {
            table.draw();
        });

        table.draw();

    });
</script>
@endsection