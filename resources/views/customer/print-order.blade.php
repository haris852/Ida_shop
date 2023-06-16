<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        {{ env('APP_NAME') }}
    </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Manrope-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Alert -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        * {
            font-family: 'Manrope', sans-serif;
        }

        button {
            font-family: 'Manrope', sans-serif;
        }
    </style>

    @stack('css-internal')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="p-5">

    <!-- invoice receipt -->
    <div class="container print">
        <div class="card">
            <div class="card-header">
                Invoice
                <strong>
                    {{ $order->transaction_code }}
                </strong>
                <span class="float-right"> <strong>Status:</strong>
                    {{ $order->status == 'pending'
                        ? 'Menunggu Pembayaran'
                        : ($order->status == 'paid'
                            ? 'Pesanan Dibayar'
                            : ($order->status == 'confirmed'
                                ? 'Pesanan Dikonfirmasi'
                                : ($order->status == 'delivered'
                                    ? 'Pesanan Dikirim'
                                    : ($order->status == 'success'
                                        ? 'Pesanan Selesai'
                                        : 'Pesanan Dibatalkan')))) }}</span>

            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-3">Pengirim:</h6>
                        <div>
                            <strong>{{ $configuration->name }}</strong>
                        </div>
                        <p>
                            {{ $configuration->address }}
                        </p>
                    </div>

                    <div class="col-sm-6">
                        <h6 class="mb-3">Pelanggan:</h6>
                        <div>
                            <strong>
                                {{ $order->receiver_name }}
                            </strong>
                        </div>
                        <p>
                            {{ $order->receiver_address }}
                        </p>
                    </div>
                </div>

                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>

                                <th class="right">Harga</th>
                                <th class="center">Jumlah</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->transactionDetail as $data)
                                <tr>
                                    <td class="center">{{ $loop->iteration }}</td>
                                    <td class="left strong">{{ $data->product->name }}</td>

                                    <td class="right">
                                        {{ number_format($data->price, 0, ',', '.') }}
                                    </td>
                                    <td class="center">
                                        {{ $data->qty }}
                                    </td>
                                    <td class="right">
                                        {{ number_format($data->total_price, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">

                    </div>

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">
                                        Rp. {{ number_format($order->total_payment, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Biaya Pengiriman</strong>
                                    </td>
                                    <td class="right">
                                        Rp. {{ number_format($order->shipping_price, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Total Pembayaran</strong>
                                    </td>
                                    <td class="right">
                                        <strong>
                                            Rp. {{ number_format($order->total_price, 0, ',', '.') }}
                                        </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script>
        $(function () {
            window.print();
        });
    </script>
</body>

</html>
