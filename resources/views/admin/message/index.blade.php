@extends('admin.layout.master')
@push('css-internal')
    <link rel="stylesheet" href="{{ asset('assets/css/chat.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="messaging">
                <div class="inbox_msg rounded">
                    <div class="inbox_people">
                        <div class="headind_srch">
                            <div class="recent_heading w-100 pt-3">
                                <h5>Daftar Pengguna</h4>
                            </div>
                        </div>
                        <div class="inbox_chat overflow-y-auto">
                            @foreach ($users as $user)
                                <div class="chat_list" id="{{ $user->id }}">
                                    <div class="chat_people">
                                        <div class="chat_img">
                                            <img src="{{ $user->avatar ? asset('storage/avatar/' . $user->avatar) : asset('assets/image/defaultuser.jpg') }}"
                                                alt="sunil" class="rounded-circle">
                                        </div>
                                        <div class="chat_ib d-flex justify-content-between">
                                            <h5 class="mb-0">{{ ucfirst($user->name) }}</h5>
                                            <span class="badge badge-danger d-none" id="unread_count">
                                                {{ $user->unread ? $user->unread : '' }}
                                            </span>
                                            <span class="chat_date text-small text-gray">{{ $user->email }} </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mesgs overflow-y-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js-internal')
        <script>
            let receiver_id = '';
            let my_id = "{{ Auth::id() }}";

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('d41022a17b37cc76c142', {
                cluster: 'ap1'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                $('#' + data.sender_id + ' #unread_count').removeClass('d-none');
                let unread = parseInt($('#' + data.sender_id + ' #unread_count').html());
                if (unread) {
                    $('#' + data.sender_id + ' #unread_count').html(unread + 1);
                } else {
                    $('#' + data.sender_id + ' #unread_count').html(1);
                }

                // if receiver is selected, reload the selected user ...
                if (receiver_id == data.sender_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('admin.message.show', ':id') }}".replace(':id', receiver_id),
                        data: "",
                        cache: false,
                        success: function(data) {
                            $('.mesgs').html(data);
                            scrollToBottomFunc();
                            $.ajax({
                                type: "POST",
                                url: "{{ route('admin.message.read') }}",
                                data: {
                                    sender_id: receiver_id,
                                    _token: "{{ csrf_token() }}"
                                },
                                cache: false,
                                success: function(data) {
                                    $('#' + receiver_id + ' #unread_count').html('');
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('admin.message.read') }}",
                                        data: {
                                            sender_id: receiver_id,
                                            _token: "{{ csrf_token() }}"
                                        },
                                        cache: false,
                                        success: function(data) {
                                            $('#' + receiver_id +
                                                ' #unread_count').html(
                                                '');
                                            $('#unread').addClass('d-none');
                                        }
                                    });
                                }
                            });
                        }
                    });
                } else {
                    $('#unread').removeClass('d-none');
                }
            });

            function scrollToBottomFunc() {
                $('.mesgs').animate({
                    scrollTop: $('.mesgs').get(0).scrollHeight
                }, 50);
            }

            $(function() {
                $('.chat_list').click(function() {
                    $('.chat_list').removeClass('active_chat');
                    $(this).addClass('active_chat');
                    receiver_id = $(this).attr('id');

                    $.ajax({
                        type: "GET",
                        url: "{{ route('admin.message.show', ':id') }}".replace(':id', receiver_id),
                        data: "",
                        cache: false,
                        success: function(data) {
                            $('.mesgs').html(data);
                            scrollToBottomFunc();
                            $.ajax({
                                type: "POST",
                                url: "{{ route('admin.message.read') }}",
                                data: {
                                    sender_id: receiver_id,
                                    _token: "{{ csrf_token() }}"
                                },
                                cache: false,
                                success: function(data) {
                                    $('#' + receiver_id + ' #unread_count').html('');
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('admin.message.read') }}",
                                        data: {
                                            sender_id: receiver_id,
                                            _token: "{{ csrf_token() }}"
                                        },
                                        cache: false,
                                        success: function(data) {
                                            $('#' + receiver_id +
                                                ' #unread_count').html(
                                                '');
                                            $('#unread').addClass('d-none');
                                        }
                                    });
                                }
                            });
                        }
                    });
                });
            });

            function btnSend() {
                let message = $('#message').val();
                if (receiver_id !== '' && message !== '') {
                    $('#message').val('');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.message.send') }}",
                        data: {
                            receiver_id: receiver_id,
                            message: message,
                            _token: "{{ csrf_token() }}"
                        },
                        cache: false,
                        success: function(data) {
                            $('.mesgs').html(data);
                            scrollToBottomFunc();
                        }
                    });
                }
            }
        </script>
    @endpush
@endsection
