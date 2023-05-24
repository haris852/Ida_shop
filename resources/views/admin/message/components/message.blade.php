<div class="msg_history">
    @foreach ($messages as $message)
        @if ($message->from == Auth::id())
            <div class="outgoing_msg mb-3">
                <div class="sent_msg">
                    <p>{{ $message->message }}</p>
                    <span class="time_date">
                        {{ \Carbon\Carbon::parse($message->created_at)->format('h:i A | F j') }}
                    </span>
                </div>
            </div>
        @else
            <div class="incoming_msg mb-3">
                <div class="incoming_msg_img"> <img
                        src="{{ $message->user->avatar ? asset('storage/avatar/' . $message->user->avatar) : asset('assets/image/defaultuser.jpg') }}"
                        alt="sunil" class="rounded-circle">
                </div>
                <div class="received_msg">
                    <div class="received_withd_msg">
                        <p>
                            {{ $message->message }}
                        </p>
                        <span class="time_date">
                            {{ \Carbon\Carbon::parse($message->created_at)->format('h:i A | F j') }}
                        </span>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

<div class="type_msg">
    <div class="input_msg_write">
        <input type="text" class="write_msg" id="message" placeholder="Type a message" />
        <button class="msg_send_btn" type="button" onclick="btnSend()">
            <i class="mdi mdi-send"></i>
        </button>
    </div>
</div>
