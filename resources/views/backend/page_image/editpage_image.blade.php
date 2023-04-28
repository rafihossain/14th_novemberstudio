@extends('backend.layouts.app')
@section('title', 'Edit Page')
@section('content')

<form method="post" action="{{route('backend.pageimage-update')}}" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="form-group mb-2">
                <label>Choose Page</label>
                <select class="form-control" name="page_id" id="pageId">
                    <!-- <option value="">Select Page</option> -->
                    @foreach ($pages as $page)
                        <option value="{{ $page->id }}"
                        {{ $page->id == $page_id ? 'selected' : '' }}>{{ $page->page_title }}</option>
                    @endforeach
                </select>
                @error('page_id')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            @if($page_id == 2)
            <div class="form-group mb-2">
                <label>About Us</label>
                <input type="file" class="dropify" name="aboutus_image" data-default-file="{{ asset('admin/image/page_image/'.$editpage->page_image ) }}">
            </div>
            @endif
            @if($page_id == 4)
            <div class="form-group mb-2">
                <label>Portfolio</label>
                <input type="file" class="dropify" name="portfolio_image" data-default-file="{{ asset('admin/image/page_image/'.$editpage->page_image ) }}">
            </div>
            @endif
            @if($page_id == 5)
            <div class="form-group mb-2">
                <label>Packages</label>
                <input type="file" class="dropify" name="package_image" data-default-file="{{ asset('admin/image/page_image/'.$editpage->page_image ) }}">
            </div>
            @endif
            @if($page_id == 6)
            <div class="form-group mb-2">
                <label>Faq</label>
                <input type="file" class="dropify" name="faq_image" data-default-file="{{ asset('admin/image/page_image/'.$editpage->page_image ) }}">
            </div>
            @endif
            @if($page_id == 7)
            <div class="form-group mb-2">
                <label>Contact Us</label>
                <input type="file" class="dropify" name="contactus_image" data-default-file="{{ asset('admin/image/page_image/'.$editpage->page_image ) }}">
            </div>
            @endif
        </div>
    </div>
 

    <div class="text-center">
        <button class="btn btn-primary" type="submit"> Save Page </button>
    </div>
</form>


<script>
    $('#pageId').on('change', function() {
        var pageId = $(this).val();
        window.location.href = "{{ route('backend.manage-pageimage') }}/"+pageId;
    });

    $('.dropify').dropify();
</script>

@endsection