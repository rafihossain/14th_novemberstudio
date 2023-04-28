@extends('backend.layouts.app')

@section('content')
<!-- <div class="card">-->
<!--    <div class="card-body">-->
<!--        <h4 class="m-0 header-title text-end float-end">-->
<!--            <a class="btn btn-primary" href="{{ url('/addpayment') }}"> + Add Payment </a>-->
<!--        </h4>-->
<!--    </div>-->
<!--</div>-->

<div class="row">
    <div class="col-12">
        
        <div class="card">
            <div class="card-body table-responsive">
                <table id="datatable" class="table table-bordered table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>User Name </th>
                            <th>Deposit Amount </th>
                            <th>Balance Due</th>
                            <th>Next Payment</th>
                            <th>Next Payment Amount </th>
                            <th>Notes </th>
                             <th>Status </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                        <td>{{ $payment->getusers->name }}</td>
                        <td>${{ $payment->deposit_amount }}</td>
                        <td>${{ $payment->due_balance }}</td>
                        <td>{{ $payment->next_payment }}</td>
                        <td>${{ $payment->next_paymet_amount }}</td>
                        <td>{{ strip_tags($payment->notes) }}</td>
                        <td><span class="badge bg-info">{{ ($payment->status == 0 ? 'Due': 'Paid' ) }}</span></td>
                         
                            <td> 
                                <a href="{{ route('backend.payment-edit', $payment->id) }}" class="btn btn-sm btn-primary waves-effect waves-light"><i class="mdi mdi-square-edit-outline"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> <!-- end row -->
<!-- Standard modal content -->
<!--<div id="requestpayment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addcontact-modalLabel" aria-hidden="true">-->
<!--    <div class="modal-dialog modal-lg">-->
<!--        <div class="modal-content">-->
<!--            <form id="user_form_submit">-->
<!--                <div class="modal-header">-->
<!--                    <h4 class="modal-title" id="addcontact-modalLabel">Next Payment </h4>-->
<!--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
<!--                </div>-->
<!--                <div class="modal-body">-->
<!--                    <div class="mb-2">-->
<!--                        <label class="form-label">Balance Due</label>-->
<!--                        <input type="text" disabled="" class="form-control" value="$300" name="">-->
<!--                    </div>-->
<!--                    <div class="form-check form-switch mb-2">-->
<!--                        <input type="checkbox" class="form-check-input" id="customSwitch1">-->
<!--                        <label class="form-check-label" for="customSwitch1">Full Paid</label>-->
<!--                    </div> -->
<!--                    <div class="dueamounts">-->
<!--                    <div class="mb-2">-->
<!--                        <label class="form-label">Event Date &amp; Time </label>-->
<!--                        <input type="date" class="form-control" name="date_time">-->
<!--                    </div>-->
<!--                    </div>-->
<!--                    <div class="dueamounts">-->
<!--                        <div class="mb-2">-->
<!--                            <label class="form-label">Next Payment Due Amount</label>-->
<!--                            <input type="text" class="form-control" value="" name="">-->
<!--                        </div>-->
<!--                    </div> -->
<!--                    <div class="mb-2">-->
<!--                        <label class="form-label">Special Notes </label>-->
<!--                         <textarea class="form-control" id="editor1"></textarea>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="modal-footer">-->
<!--                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>-->
<!--                    <button type="submit" class="btn btn-primary user_submit">Add Payment </button>-->
<!--                </div>-->
<!--            </form>-->
    <!--     </div><!-- /.modal-content 
   </div><!-- /.modal-dialog 
</div><!-- /.modal -->



@endsection
@section('script')
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
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


$(".dueamounts").show();
$( "body" ).delegate( "#customSwitch1", "click", function() {
    if($(this).is(":checked")) {
        $(".dueamounts").hide(300);
    } else {
        $(".dueamounts").show(200);
    }
});

</script>


@endsection