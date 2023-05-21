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

                            @if ($order->payment_method == 1)
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
                            @elseif ($order->payment_method == 2)
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
                                <div class="card-text d-flex justify-content-between align-items-center">
                                    <div class="m-0">
                                        <span class="font-weight-bold">Status Pesanan</span>
                                    </div>
                                    <div>
                                        <span
                                            class="font-weight-bold {{ $order->status == 'pending' ? 'text-dark' : ($order->status == 'delivered' ? 'text-secondary' : ($order->status == 'confirmed' ? 'text-info' : ($order->status == 'paid' ? 'text-dark' : ($order->status == 'success' ? 'text-success' : 'text-danger')))) }}">
                                            {{ $order->status == 'pending' ? 'Menunggu Pembayaran' : ($order->status == 'delivered' ? 'Diantar' : ($order->status == 'confirmed' ? 'Dikonfirmasi' : ($order->status == 'paid' ? 'Dibayar' : ($order->status == 'success' ? 'Selesai' : 'Dibatalkan')))) }}
                                        </span>
                                    </div>
                                </div>
                            @endif
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

                                    @if ($order->status == 'confirmed')
                                        <ul id="progressbar" class="mb-4">
                                            <li class="step0 active" id="step1">Menunggu</li>
                                            <li class="step0 active text-center" id="step2">Dikonfirmasi</li>
                                            <li class="step0 text-right" id="step3">Diantar</li>
                                            <li class="step0 text-right" id="step4">Diterima</li>
                                        </ul>
                                    @endif

                                    @if ($order->status == 'delivered')
                                        <ul id="progressbar" class="mb-4">
                                            <li class="step0 active" id="step1">Menunggu</li>
                                            <li class="step0 active text-center" id="step2">Dikonfirmasi</li>
                                            <li class="step0 active text-right" id="step3">Diantar</li>
                                            <li class="step0 text-right" id="step4">Diterima</li>
                                        </ul>
                                    @endif

                                    @if ($order->status == 'success')
                                        <ul id="progressbar" class="mb-4">
                                            <li class="step0 active" id="step1">Menunggu</li>
                                            <li class="step0 active text-center" id="step2">Dikonfirmasi</li>
                                            <li class="step0 active text-right" id="step3">Diantar</li>
                                            <li class="step0 active text-right" id="step4">Diterima</li>
                                        </ul>
                                    @endif

                                    @if ($order->status == 'failed')
                                        {{-- alert --}}
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Pesanan Dibatalkan</strong>
                                        </div>
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
                                @if ($order->review == null && $order->status == 'success')
                                    <button type="button" class="btn btn-success btn-block mt-2" data-toggle="modal"
                                        data-target="#reviewModal" onclick="review('{{ $order->id }}')">
                                        Beri Ulasan
                                    </button>
                                @endif
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

    <!-- Modal Payment -->
    <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="paymentLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title font-weight-bold" id="paymentLabel">
                        Formulir Pembayaran
                    </p>
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

                    <div class="mt-3">
                        <span class="">Alamat Penerima</span>
                        <span class="font-weight-medium float-right" id="receiver_address"></span>
                    </div>

                    <div class="mt-1">
                        <span class="">Nomer Penerima</span>
                        <span class="font-weight-bold float-right" id="receiver_phone"></span>
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

    <!-- Modal Review -->
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title font-weight-bold" id="reviewModalLabel">
                        Review Produk
                    </p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>Rating produk ini</span><br>
                    <input type="hidden" name="id">
                    <div id="rate"></div>
                    <x-textarea name="review" id="review" placeholder="Tulis ulasan anda disini" required />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Tutup
                    </button>
                    <button type="button" class="btn btn-primary" id="btnReview">
                        Review Produk
                    </button>
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

                        $('#receiver_address').html(data.receiver_address);
                        $('#receiver_phone').html(data.receiver_phone);

                        // E Money Label
                        if (data.status == 'pending') {
                            $('#cod_label').html(
                                    'Silahkan lakukan pembayaran sebesar <span class="font-weight-bold">Rp. ' + data
                                    .total_price + '</span> kepada kurir kami saat pesanan sampai di tujuan.')
                                .removeClass('d-none').addClass('d-block');
                        } else if (data.status == 'paid') {
                            $('#cod_label').html('Menunggu konfirmasi').removeClass('d-none').addClass(
                                'd-block');
                            $('#proof_container').removeClass('d-none');
                            $('#proof_of_payment').addClass('d-none');
                            $('#proof_of_payment_preview').attr('src', "{{ asset('storage/payment') }}/" + data
                                .proof_of_payment);
                        } else if (data.status == 'confirmed') {
                            $('#cod_label').html('Pesanan sedang diproses').removeClass('d-none').addClass(
                                'd-block');
                        } else if (data.status == 'failed') {
                            $('#cod_label').html('Pembayaran gagal').removeClass('d-none').addClass('d-block');
                        } else if (data.status == 'delivered') {
                            $('#cod_label').html('Pesanan sedang dikirim').removeClass('d-none').addClass(
                                'd-block');
                        } else if (data.status == 'success') {
                            $('#cod_label').html('Pesanan telah diterima').removeClass('d-none alert-warning')
                                .addClass('alert-success d-block');
                        }

                        if (data.payment_method == 2) {
                            $('#emoney_phone').addClass('d-none');
                        } else {
                            $('#emoney_phone').removeClass('d-none');
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

            function review(id) {
                $('#reviewModal input[name="id"]').val(id);
                $('#rate').html(`
                <div class="rate ml-0">
                        <input type="radio" id="star5" name="rate" value="5" />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rate" value="4" />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rate" value="3" />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rate" value="2" />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rate" value="1" />
                        <label for="star1" title="text">1 star</label>
                    </div>
                `);
                $('textarea[name="review"]').val('');
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

                $('#btnReview').click(function(e) {
                    e.preventDefault();
                    let rating = 0;
                    let review = '';

                    $('#reviewModal input[name="rate"]').each(function() {
                        if ($(this).is(':checked')) {
                            rating = $(this).val();
                        }
                    });

                    review = $('#reviewModal textarea[name="review"]').val();

                    if (rating == 0) {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Rating harus diisi',
                            icon: 'error'
                        });
                        return;
                    }

                    if (review == '') {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Review harus diisi',
                            icon: 'error'
                        });
                        return;
                    }

                    $.ajax({
                        url: "{{ route('user-customer.order.review', ':id') }}"
                            .replace(':id', $('#reviewModal input[name="id"]').val()),
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            rating: rating,
                            review: review
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: response.message,
                                    icon: 'success'
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: response.message,
                                    icon: 'error'
                                });
                            }
                        },
                    })
                });
            });
        </script>
    @endpush
@endsection
