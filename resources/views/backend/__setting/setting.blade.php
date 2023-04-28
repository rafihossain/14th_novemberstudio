@extends('backend.layouts.app')

@section('content')
 

<div class="card">
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label class="form-label"> Site Name </label>
                        <input type="text" class="form-control" name="" value="14th November Studio">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label"> Meta Title </label>
                        <input type="text" class="form-control" name="" value="14th November Studio | Etobicoke Videography">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label"> Meta Keyword</label>
                        <input type="text" class="form-control" name="" value="14th November Studio offers a wide variety of cinematography and photography services world-wide. We specialize in weddings of all cultures, traditions and genres including aerial drone services.">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label"> Meta Description </label>
                        <textarea class="form-control"> 14th November Studio offers a wide variety of cinematography and photography services world-wide. We specialize in weddings of all cultures, traditions and genres including aerial drone services. </textarea>
                    </div>
                </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="form-label"> Site logo </label>
                     <input type="file" class="dropify" name="logo" data-default-file="assets/images/logo-dark.png">
                </div>
            </div> 
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="form-label"> Footer Copy Right Text </label>
                    <input type="text" class="form-control" value="© 2022 14thnovemberstudio. All Rights Reserved." placeholder=""  name="">
                </div>
            </div>
         
          
         </div> 
            <div class=" mt-4">
                <button class="btn btn-primary" type="submit"> Save Setting </button>
            </div>
        </form>
    </div>
</div>

@endsection
@section('script')
 <script type="text/javascript">
     $('.dropify').dropify();
 </script>

@endsection