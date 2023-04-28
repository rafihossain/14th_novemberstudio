@extends('backend.layouts.app')
@section('title', 'List Faq')
@section('content')
<div class="text-end mb-3">
    <a href="{{ route('backend.faq-add') }}" class="btn btn-primary "><i class="mdi mdi-plus"></i>Add Faq</a>
</div>

@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body">
        <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
            <thead>
                <tr>
                    <th>SL No</th>
                    <th> Faq Qus</th>
                    <th> Faq Descriptions</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 1; ?>
                @foreach($faqs as $faq)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $faq->faq_question}}</td>
                        <td>{!! $faq->faq_answare !!}</td>
                        @if($faq->id != 0)
                        <td>
                            <a href="{{ route('backend.faq-edit',  $faq->id) }}" class="btn btn-sm btn-success"><i class="mdi mdi-file-edit-outline"></i></a>
                            <a href="{{ route('backend.faq-delete',  $faq->id) }}" id="delete" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can-outline"></i></a>
                        </td>
                        @endif
                    </tr>
                <?php $i++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection