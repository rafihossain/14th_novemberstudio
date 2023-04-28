@extends('backend.layouts.app')

@section('content')
 <div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
           <a class="btn btn-primary" href="{{ route('backend.edit-users',['id'=> $payment->getusers->id]) }}"><i class="fe-chevron-left"></i> Back to Client profile</a>
            <a class="btn btn-primary" href="{{ route('backend.payment-list') }}"><i class="fe-chevron-left"></i> Payment List</a>
        </h4>
    </div>
</div>
@if($payment->status == 1)
<style>
    .dueamounts{
        display:none;
    }
</style>
@endif
 
  <form action="{{route('backend.payment-update')}}" method="POST">
    <div class="card"> 
        <div class="card-body"> 
        	 
                @csrf
                <input type="hidden" name="payment_id" value="{{ $payment->id }}">
          	<div class="row"> 
          		<div class="col-md-12 mb-2">
                    <label class="form-label">User </label> 
                    <input type="text" class="form-control" value="{{ $payment->getusers->name}}" readonly>
                </div>
                
                <div class="col-md-12 mb-2">
                    <label class="form-label">Total Amount ( CAD ) </label> 
                    <input type="text" class="form-control" name="deposit_amount" value="{{ $payment->deposit_amount }}">
                </div> 
                <div class="col-md-12 mb-2">
                	<div class="form-check form-switch ">
	                    <input type="checkbox" name="status" {{ ($payment->status == 1 ? 'checked':'' )}} value="1" class="form-check-input" id="customSwitch1">
	                    <label class="form-check-label" for="customSwitch1">Full Paid</label>
	                </div>
                </div>
                
                <div class="dueamounts">
                <div class="col-md-12 mb-2 ">
                    <label class="form-label">Advance Payment</label> 
                    <input type="text" class="form-control" name="advance_amount" value="{{ $payment->advance_amount }}">
                </div>
                <div class="mb-2">
                    <label class="form-label">Next Payment Amount</label>
                    <input type="text" class="form-control" name="next_paymet_amount" value="{{ $payment->next_paymet_amount }}">
                </div>
                <div class="mb-2">
                    <label class="form-label">Next Payment date</label>
                   <input  type="date" class="form-control" name="next_payment" value="{{ $payment->next_payment }}">
                </div> 
                </div>
                
                
                 <div class="col-md-12 mb-2">
                    <label class="form-label">Event Date &amp; Time </label>
                    <input type="date" class="form-control" name="expected_delivery" value="{{ $payment->expected_delivery }}">
                </div>
                
                
                
                <div class="col-md-12 mb-2">
                    <label class="form-label">Special Notes </label> 
                    <textarea class="form-control" name="notes" id="editor1" >{{ $payment->notes }}</textarea>
                </div>
               
        	</div>
        	<br>
        	<div>
		        <button class="btn btn-primary" type="submit"> Update Payment</button>
		    </div>
        </div>
    </div> 
</form>
 

@endsection
@section('script')
<!--CK editor-->
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
 <script type="text/javascript">
 	ClassicEditor.create( document.querySelector( '#editor1' ) )
		.then( editor => {
			window.editor1 = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} ); 
//	$(".dueamounts").show();
	$( "body" ).delegate( "#customSwitch1", "click", function() {
	    if($(this).is(":checked")) {
	        $(".dueamounts").hide(300);
	    } else {
	        $(".dueamounts").show(200);
	    }
	});
 </script>
@endsection