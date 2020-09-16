@if($message->from_user == \Auth::user()->id)

    <div class="direct-chat-msg right base_sent row" data-message-id="{{ $message->id }}">
        <div class="col-md-2 col-xs-2 avatar">
        </div>
        <div class="col-md-10 col-xs-10 mr-0 ml-5">
            <div class="direct-chat-text text-right" style="color:white">
                <p style="margin-bottom:4px">{!! $message->content !!}</p>
                <time datetime="{{ date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString())) }}">{{ $message->fromUser->name }} • {{ $message->created_at->diffForHumans() }}</time>
            </div>
        </div>
    </div>

@else

    <div class="direct-chat-msg left base_receive row" data-message-id="{{ $message->id }}">
        <div class="col-md-2 col-xs-2 avatar">
        </div>
        <div class="col-md-10 col-xs-10  mr-0 ml-0">
            <div class="direct-chat-text text-left ml-1" style="color:black">
                <p style="margin-bottom:4px">{!! $message->content !!}</p>
                <time datetime="{{ date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString())) }}">{{ $message->fromUser->name }} • {{ $message->created_at->diffForHumans() }}</time>
            </div>
        </div>
    </div>

@endif