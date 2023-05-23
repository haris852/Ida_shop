@extends('customer.layout.master')
@push('css-internal')
    <link rel="stylesheet" href="{{ asset('assets/css/chat.css') }}">
@endpush
@section('content')
    <!-- Menu -->
    <div class="text-center mt-5 mb-3">
        <h4 class="font-weight-bold">Pesan <small>{{ $unread > 0 ? '(' . $unread . ')' : '' }}</small></h4>
        <p>
            <a href="{{ route('home') }}" class="text-decoration-none">Home</a> / Pesan
        </p>
    </div>

    <div class="row mt-5 justify-content-center">
        <div class="col-md-6">
            <div class="messaging">
                <div class="inbox_msg rounded p-2">
                    <div class="msgs">
                        <div class="msg_history overflow-y-auto">
                            @foreach ($messages as $message)
                                @if ($message->to == Auth::id())
                                    <div class="outgoing_msg mb-3">
                                        <div class="sent_msg">
                                            <p>{{ $message->message }}</p>
                                            <span class="time_date">{{ $message->created_at->diffForHumans() }}</span>
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
                                                    {{-- 11:01 AM | June 9 --}}
                                                    {{ \Carbon\Carbon::parse($message->created_at)->format('h:i A | F j') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="type_msg">
                        <div class="input_msg_write">
                            <input type="text" class="write_msg" id="message" placeholder="Type a message" />
                            <button class="msg_send_btn" type="button" onclick="btnSend()">
                                <i class="mdi mdi-send"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js-internal')
        <script>

            function scrollToBottomFunc()
            {
                $('.msg_history').animate({
                    scrollTop: $('.msg_history').get(0).scrollHeight
                }, 50);
            }
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('d41022a17b37cc76c142', {
                cluster: 'ap1'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                // check if you are the receiver of the message
                if(data.receiver_id == '{{ Auth::id() }}'){
                    // if you are the receiver then reload the messages
                    $('#message').val('');
                    $.ajax({
                        type: "GET",
                        url: "{{ route('user.message.message') }}",
                        data: {
                            receiver_id: data.receiver_id
                        },
                        cache: false,
                        success: function(data) {
                            location.reload();
                        }
                    });
                }else{
                    // if you are not the receiver then add the unread message count
                    let unread = parseInt($('#' + data.receiver_id).find('.unread').html());
                    if (unread) {
                        $('#' + data.receiver_id).find('.unread').html(unread + 1);
                    } else {
                        $('#' + data.receiver_id).append('<span class="unread">1</span>');
                    }
                }
            });

            let my_id = "{{ Auth::id() }}";

            function btnSend() {
                let message = $('#message').val();
                if (message !== '') {
                    $('#message').val('');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('user.message.send') }}",
                        data: {
                            message: message,
                            _token: "{{ csrf_token() }}"
                        },
                        cache: false,
                        success: function(data) {
                            location.reload();
                        }
                    });
                }
            }
        </script>
    @endpush
@endsection
