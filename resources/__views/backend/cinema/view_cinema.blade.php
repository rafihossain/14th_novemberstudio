@extends('backend.layouts.app')
@section('content')
<div class="card">
	<div class="card-body">
        <div class="form-group mb-2">
            <label>Cinema Title :</label>
            {{$cinema->cinema_title}}
        </div>
        <div class="form-group mb-2">
            <label>Meta Title :</label>
            {{$cinema->meta_title}}
        </div>
        <div class="form-group mb-2">
            <label>Meta Keywords :</label>
            {{$cinema->meta_keywords}}
        </div>
        <div class="form-group mb-2">
            <label>Meta Description :</label>
            {{$cinema->meta_description}}
        </div>
        <div class="form-group mb-2">
            <label>Cinema Category :</label>
            {{$cinema->category->category_name}}
        </div>
        <div class="form-group mb-2">
            <label>Cinema Image :</label>
            <div class="mt-2">
                <img src="{{asset($cinema->cinema_image)}}" height="80" alt="cinema-image">
            </div>
        </div>
        <div class="form-group mb-2">
            <label>Cinema Description :</label>
            {!!$cinema->cinema_description!!}
        </div>
	</div>
</div>
@endsection