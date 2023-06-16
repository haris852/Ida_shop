<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        {{ env('APP_NAME') }}
    </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/image/logo.png') }}">

    @include('admin.layout.header')

    @stack('css-internal')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('admin.layout.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            {{-- @include('admin.layout.setting') --}}
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            @include('admin.layout.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')

                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                @include('admin.layout.partial-footer')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.layout.footer')
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    <!-- Push Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.8/push.min.js"
        integrity="sha512-eiqtDDb4GUVCSqOSOTz/s/eiU4B31GrdSb17aPAA4Lv/Cjc8o+hnDvuNkgXhSI5yHuDvYkuojMaQmrB5JB31XQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('d41022a17b37cc76c142', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('new-order');
        channel.bind('new-order-event', function(data) {
            Push.create('Anda berhasil memesan', {
                body: 'Pesanan baru dari ' + data.name + ' status ' + data.status,
                icon: '{{ asset('customer_asset/img/logo.svg') }}',
                timeout: 5000,
                onClick: function() {
                    window.location.href = "{{ route('home') }}"
                }
            });
        });

        var orderStatusChannel = pusher.subscribe('order-status');
        orderStatusChannel.bind('order-status-event', function(data) {
            Push.create('Status pesanan berubah', {
                body: 'Pesanan ' + data.transaction_code + ' status ' + data.status,
                icon: '{{ asset('customer_asset/img/logo.svg') }}',
                timeout: 5000,
            });
        });
    </script>

    @stack('js-internal')
</body>

</html>
