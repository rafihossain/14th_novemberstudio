
@if($message->sender_id == \Auth::user()->id)
    <div class="row msg_container base_sent" data-message-id="{{ $message->id }}">
        <div class="col-9">
            <div class="messages msg_sent text-right">
                <p>{!! $message->message !!}</p>
                <time datetime="{{ date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString())) }}">{{ $message->user->name }} • {{ $message->created_at->diffForHumans() }}</time>
            </div>
        </div>
        <div class="col-3 avatar">
            <img src="{{ url('/') }}/{{ $message->user->avatar }}" width="50" height="50" class="img-responsive">
        </div>
    </div>

@else

    <div class="row msg_container base_receive" data-message-id="{{ $message->id }}">
        <div class="col-3 avatar">
            <img src="{{ url('/') }}/{{ $message->user->avatar }}" width="50" height="50" class=" img-responsive ">
        </div>
        <div class="col-9">
            <div class="messages msg_receive text-left">
                <p>{!! $message->message !!}</p>
                <time datetime="{{ date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString())) }}">{{ $message->user->name }} • {{ $message->created_at->diffForHumans() }}</time>
            </div>
        </div>
    </div>

@endif
