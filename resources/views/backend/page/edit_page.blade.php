@extends('backend.layouts.app')
@section('title', 'Edit Page')
@section('content')

<form method="post" id="addpage" action="{{route('backend.pageupdate')}}">
    @csrf
    <div class="card">
        <div class="card-body">
            <input type="hidden" name="page_id" id="" value="{{$page['id']}}">
            <div class="form-group mb-2">
                <label>Page Name</label>
                <input type="text" class="form-control" name="page_name" value="{{$page['page_name']}}">
                @error('page_name')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label>Page Title</label>
                <input type="text" class="form-control" name="page_title" value="{{$page['page_title']}}">
                @error('page_title')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label>Page Url</label>
                <input type="text" class="form-control" name="page_url" value="{{$page['page_url']}}">
                @error('page_url')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label>Meta Title</label>
                <input type="text" class="form-control" name="meta_title" value="{{$page['meta_title']}}">
                @error('meta_title')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label>Meta Key Word</label>
                <input type="text" class="form-control" name="meta_key_word" value="{{$page['meta_key_word']}}">
                @error('meta_key_word')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label>Meta Description</label>
                <textarea class="form-control" name="meta_description">{{$page['meta_description']}}</textarea>
                @error('meta_description')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
          
            <div class="form-group mb-2">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="1" @if($page['status']==1) selected @endif>Publish</option>
                    <option value="2" @if($page['status']==2) selected @endif>Unpublish</option>
                    <option value="3" @if($page['status']==3) selected @endif>Deleted</option>
                </select>
                @error('country')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>
    </div>
    @foreach($page['page_section'] as $page_sections)
    <div class="card">
        <div class="card-body">
            <div class="row align-items-end">
                <div class="col-10">
                    <div class="form-group">
                        <label> Section</label>
                        <select class="form-control" name="page_section[]">
                            @foreach($section as $key=>$sections)
                            <option value="{{$sections['section_name']}}" @if($page_sections['section']==$sections['section_name']) selected @endif>{{$sections['section_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-2"> <button class="btn btn-danger removecontentsection" type="button"><i class="mdi mdi-trash-can-outline"></i></button> </div>
            </div>
        </div>
    </div>
    @endforeach
    <h4>Add section</h4>
    <div class="contentsection"></div>
    <div class="addpagesection"> <i class="mdi mdi-plus"></i> </div>

    <div class="text-center">
        <button class="btn btn-primary" type="submit"> Save Page </button>
    </div>
</form>


<script type="text/javascript">
    $(document).ready(function() {
        var s2 = $("#select_country").select2({
            placeholder: "Choose Cuontry",
            tags: true
        });
        var vals = <?php echo json_encode($page['country']) ?>;
        var new_vals = vals.split(',');
        s2.val(new_vals).trigger("change");

        var section = <?php echo json_encode($section); ?>;
        var section_new = '';
        for (var i = 0; i < section.length; i++) { //console.log(section[i]);
            section_new += '<option value="' + section[i].section_name + '">' + section[i].section_name + '</option>';
        }

        $(".addpagesection").click(function() {
            $('.contentsection').append('<div class="card"> <div class="card-body"><div class="row align-items-end"><div class="col-10"> <div class="form-group"> <label> Section</label> <select class="form-control" name="page_section[]"> <option value="">Select Section</option>' + section_new + '</select></div></div> <div class="col-2"> <button class="btn btn-danger removecontentsection" type="button"><i class="mdi mdi-trash-can-outline"></i></button> </div> </div> </div> </div>');
        });
        $("body").delegate(".removecontentsection", "click", function() {
            $(this).closest('.card').remove();
        });

    });
</script>

@endsection