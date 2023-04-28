@extends('backend.layouts.app')
@section('title', 'Add Page')
@section('content')
<form method="post" id="addpage" action="{{route('backend.savepage')}}"> 
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="form-group mb-2">
                <label>Page Name</label>
                <input type="text" class="form-control" name="page_name" value="{{old('page_name')}}">
                @error('page_name')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label>Page Title</label>
                <input type="text" class="form-control" name="page_title" value="{{old('page_title')}}">
                @error('page_title')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label>Page Type</label>
                <select name="page_type" class="form-control">
                    <option value="">---Select---</option>
                    <option value="home">Home</option>
                    <option value="about_the_company">About The Company</option>
                    <option value="cinema">Cinema</option>
                    <option value="package">Package</option>
                    <option value="faq">Faq</option>
                    <option value="contact">Contact</option>
                </select>
                @error('page_type')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label>Meta Title</label>
                <input type="text" class="form-control" name="meta_title" value="{{old('meta_title')}}">
                @error('meta_title')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label>Meta Key Word</label>
                <input type="text" class="form-control" name="meta_key_word" value="{{old('meta_key_word')}}">
                @error('meta_key_word')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label>Meta Description</label>
                <textarea class="form-control" name="meta_description" value="{{old('meta_description')}}"></textarea>
                @error('meta_description')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
     
        </div>
    </div>
    
    <h4>Add section</h4>
    <div class="contentsection"></div>
    <div class="addpagesection"> <i class="mdi mdi-plus"></i> </div> 

    <div class="text-center">
        <button class="btn btn-primary" type="submit"> Save Page </button>
    </div>
    <?php //echo '<pre>';print_r($section); die();?>
</form> 


<script type="text/javascript">
    $( document ).ready(function() {
        var section=<?php echo json_encode($section);?>;
        var section_new='';
        for(var i=0; i<section.length; i++)
        {   //console.log(section[i]);
            section_new+='<option value="'+section[i].section_name+'">'+section[i].section_name+'</option>';
        }
        //console.log(section);
        $(".addpagesection").click(function () {
        $('.contentsection').append('<div class="card"> <div class="card-body"> <div class="row align-items-end"><div class="col-10"> <div class="form-group"> <label> Section</label><select class="form-control" name="page_section[]"> <option value="">Select Section</option>'+section_new+'</select></div> </div> <div class="col-2"> <button class="btn btn-danger removecontentsection" type="button"><i class="mdi mdi-trash-can-outline"></i></button> </div> </div> </div> </div>');
        });
        $( "body" ).delegate( ".removecontentsection", "click", function() { 
            $(this).closest('.card').remove();
        });
    
   });
      
</script>

@endsection