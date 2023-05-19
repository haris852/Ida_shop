@extends('customer.layout.master')
@section('content')
    <div class="py-5 text-center">
        <h4>
            Daftar Pesanan
        </h4>
        <p class="mt-2">
            <span class="text-danger">*</span>Segera lakukan pembayaran dalam 2 jam kedepan semenjak pemesanan produk
        </p>
    </div>
    @if (isset($orders) && count($orders) > 0)
        <div class="row">
            @foreach ($orders as $order)
                <div class="col-md-4 mb-3">
                    <div class="card rounded-lg">
                        <div class="card-body">
                            <h6 class="card-title">
                                Invoice
                            </h6>
                            <div class=" d-sm-block d-md-flex justify-content-between mb-4">
                                <p class="card-text m-0">
                                    {{ \Carbon\Carbon::parse($order->created_at)->isoFormat('D MMMM Y, H:MM') }} WIB
                                </p>
                                <p class="card-text m-0">
                                    {{ $order->transaction_code }}
                                </p>
                            </div>
                            <hr>
                            @foreach ($order->transactionDetail as $td)
                                <div class="card-text mb-3 d-flex justify-content-between align-items-center">
                                    <div class="m-0">
                                        <span>{{ $td->product->name }}</span><br>
                                        <span class="text-muted">
                                            {{ $td->qty }} {{ $td->product->unit }} x
                                            {{ number_format($td->product->price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="font-weight-bold">
                                            {{ number_format($td->total_price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                            <hr>
                            <div class="card-text d-flex justify-content-between align-items-center">
                                <div class="m-0">
                                    <span class="font-weight-bold">Metode Pembayaran</span>
                                </div>
                                <div>
                                    <span class="font-weight-bold">
                                        {{ $order->payment_method == 1 ? 'E Money' : 'COD (Bayar di Tempat)' }}
                                    </span>
                                </div>
                            </div>
                            @if ($order->payment_method == 1)
                                <div class="card-text d-flex justify-content-between align-items-center">
                                    <div class="m-0">
                                        <span class="font-weight-bold">Nomor Dana</span>
                                    </div>
                                    <div>
                                        <span class="font-weight-bold">
                                            {{ $storeConfiguration->phone }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                            <hr>
                            <div class="card-text d-flex justify-content-between align-items-center">
                                <div class="m-0">
                                    <span class="font-weight-bold">Ongkos Kirim</span>
                                </div>
                                <div>
                                    <span class="font-weight-bold">
                                        {{ number_format($order->shipping_price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-text mb-3 d-flex justify-content-between align-items-center">
                                <div class="m-0">
                                    <span class="font-weight-bold">Total</span>
                                </div>
                                <div>
                                    <span class="font-weight-bold">
                                        {{ number_format($order->total_price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            <div class="mt-4"></div>
                            <div class="progress-track">
                                @if ($order->payment_method == 1)
                                    @if ($order->status == 'pending')
                                        <ul id="progressbar" class="mb-4">
                                            <li class="step0 active" id="step1">Menunggu</li>
                                            <li class="step0 text-center" id="step2">Dibayar</li>
                                            <li class="step0 text-right" id="step3">Diantar</li>
                                            <li class="step0 text-right" id="step4">Diterima</li>
                                        </ul>
                                    @endif

                                    @if ($order->status == 'paid')
                                        <ul id="progressbar" class="mb-4">
                                            <li class="step0 active" id="step1">Menunggu</li>
                                            <li class="step0 active text-center" id="step2">Dibayar</li>
                                            <li class="step0 text-right" id="step3">Diantar</li>
                                            <li class="step0 text-right" id="step4">Diterima</li>
                                        </ul>
                                    @endif
                                @endif
                            </div>

                            @if ($order->status == 'pending')
                                <!-- Pembayaran menggunakan E Money -->
                                @if ($order->status == 'pending' && $order->payment_method == 1)
                                    @if (Carbon\Carbon::parse($order->created_at)->addHours(2) < Carbon\Carbon::now())
                                        <button class="btn btn-danger btn-block disabled">
                                            Pesanan Kadaluarsa
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-primary btn-block"
                                            onclick="pay('{{ $order->id }}')">
                                            {{ $order->is_confirmed == 1 ? 'Lihat Detail' : 'Bayar Sekarang' }}
                                        </button>
                                        <small class="text-muted text-center mt-2 d-block">
                                            Pesanan akan kadaluarsa dalam:
                                            <span class="font-weight-bold text-danger">
                                                {{ Carbon\Carbon::parse($order->created_at)->addHours(2)->diffForHumans() }}
                                            </span>
                                        </small>
                                    @endif
                                @elseif ($order->status == 'pending' && $order->payment_method == 2)
                                    <button type="button" class="btn btn-primary btn-block"
                                        onclick="pay('{{ $order->id }}')">
                                        Lihat Detail
                                    </button>
                                @endif
                            @elseif ($order->status !== 'pending')
                                <button type="button" class="btn btn-primary btn-block"
                                    onclick="pay('{{ $order->id }}')">
                                    Lihat Detail
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center">
            <h5>
                Tidak ada pesanan
            </h5>
        </div>
    @endif

    <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="paymentLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentLabel">
                        Formulir Pembayaran
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="order_id" name="order_id">
                    <span class="badge badge-dark" id="orderStatus"></span>

                    <div class="mt-3">
                        <span class="">Total Pembayaran</span>
                        <span class="font-weight-bold float-right" id="totalPrice"></span>
                    </div>

                    <div class="mt-1">
                        <span class="">Metode Pembayaran</span>
                        <span class="font-weight-bold float-right" id="paymentMethod"></span>
                    </div>
                    <!-- Label Nomor Dana -->
                    <div class="mt-1 border-top border-bottom py-4" id="emoney_phone">
                        <span class="">Nomor Dana</span>
                        <span class="font-weight-bold float-right" id="accountNumber">{{ $storeConfiguration->phone }}
                            (a.n
                            {{ $storeConfiguration->name }})
                    </div>
                    <div class="d-none mt-3" id="proof_container">
                        <!-- Label E Money -->
                        <small class="mb-3 d-none" id="emoney_label">
                            <span class="text-danger">*</span>
                            Silahkan lakukan pembayaran sesuai dengan total pembayaran ke nomor dana diatas dan upload bukti
                            pembayaran disini.
                        </small>
                        <x-input type="file" name="proof_of_payment" id="proof_of_payment"
                            placeholder="Bukti Pembayaran" />
                        <img src="" alt="" id="proof_of_payment_preview" class="img-fluid">
                    </div>

                    <!-- Label COD -->
                    <div class="alert alert-warning mt-3 d-none" id="cod_label">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    @push('js-internal')
        <script>
            function translateStatus(status) {
                if (status == 'pending') {
                    return 'Silahkan lakukan pembayaran';
                } else if (status == 'paid') {
                    return 'Pesanan sedang diproses';
                } else if (status == 'failed') {
                    return 'Pembayaran gagal';
                } else if (status == 'delivered') {
                    return 'Pesanan telah dikirim';
                } else if (status == 'success') {
                    return 'Pesanan telah diterima';
                }
            }

            function pay(id) {
                $('#payment').modal('show');
                let url = "{{ route('user-customer.order.show', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        $('#order_id').val(data.id);
                        $('#orderStatus').html(translateStatus(data.status));
                        if (data.status == 'pending') {
                            $('#proof_container').removeClass('d-none');
                        } else {
                            $('#proof_container').addClass('d-none');
                        }

                        // COD Label
                        if (data.status == 'pending') {
                            $('#cod_label').html(
                                    'Silahkan lakukan pembayaran sebesar <span class="font-weight-bold">Rp. ' + data
                                    .total_price + '</span> kepada kurir kami saat pesanan sampai di tujuan.')
                                .removeClass('d-none').addClass('d-block');
                        } else if (data.status == 'paid') {
                            $('#cod_label').html('Pesanan sedang diproses').removeClass('d-none').addClass(
                                'd-block');
                            // show proof of payment
                            $('#proof_container').removeClass('d-none');
                            $('#proof_of_payment').addClass('d-none');
                            $('#proof_of_payment_preview').attr('src', "{{ asset('storage/payment') }}/" + data
                                .proof_of_payment);
                        } else if (data.status == 'failed') {
                            $('#cod_label').html('Pembayaran gagal').removeClass('d-none').addClass('d-block');
                        } else if (data.status == 'delivered') {
                            $('#cod_label').html('Pesanan telah dikirim').removeClass('d-none').addClass('d-block');
                        } else if (data.status == 'success') {
                            $('#cod_label').html('Pesanan telah diterima').removeClass('d-none').addClass(
                                'd-block');
                        }

                        $('#totalPrice').html('Rp. ' + data.total_price);
                        $('#paymentMethod').html(data.payment_method == 1 ? 'E-Money' : 'COD (Cash On Delivery)');

                        if (data.payment_method == 1 && data.status == 'pending') {
                            $('#emoney_phone').removeClass('d-none');
                            $('#emoney_label').removeClass('d-none').addClass('d-block');
                            $('#proof_container').removeClass('d-none');
                            $('#cod_label').addClass('d-none').removeClass('d-block');
                        } else if (data.payment_method == 2 && data.status == 'pending') {
                            $('#emoney_phone').addClass('d-none');
                            $('#emoney_label').addClass('d-none').removeClass('d-block');
                            $('#proof_container').addClass('d-none');
                            $('#cod_label').removeClass('d-none').addClass('d-block');
                        }
                    }
                });
            }

            function cancelOrder(id) {
                let url = "{{ route('user-customer.order.destroy', ':id') }}";
                url = url.replace(':id', id);

                Swal.fire({
                    title: 'Batalkan Pesanan?',
                    text: "Pesanan akan dibatalkan dan tidak dapat dikembalikan lagi",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Batalkan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: data.message,
                                    icon: 'success'
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            },
                        })
                    }
                })
            }

            $(function() {
                $('#proof_of_payment').change(function() {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#proof_of_payment_preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);

                    $('#proof_of_payment_preview').removeClass('d-none');

                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Bukti pembayaran akan diupload dan tidak dapat diubah lagi",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: 'rgb(35, 53, 172)',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Upload',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = "{{ route('user-customer.order.confirm', ':id') }}";
                            url = url.replace(':id', $('#order_id').val());

                            let formData = new FormData();
                            formData.append('proof_of_payment', $('#proof_of_payment')[0].files[0]);
                            formData.append('_token', '{{ csrf_token() }}');

                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(data) {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        text: data.message,
                                        icon: 'success'
                                    });
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                },
                            })
                        }
                    })
                });
            });
        </script>
    @endpush
@endsection
