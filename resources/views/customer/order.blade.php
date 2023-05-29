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

    <div class="mt-4" id="statusContainer">
        <div class="row">
            <div class="col-lg text-center" onclick="detailOrder('pending')">
                <img class="rounded mb-4" src="https://cdn-icons-png.flaticon.com/512/411/411786.png"
                    alt="Generic placeholder image" width="70" height="70">
                <h5>Belum Bayar</h5>
                @if ($orders->where('status', 'pending')->count() > 0)
                    <p class="badge badge-warning font-weight-bold">
                        {{ $orders->where('status', 'pending')->count() }} item
                    </p>
                @endif
            </div>
            <div class="col-lg text-center" onclick="detailOrder('paid')">
                <img class="rounded mb-4"
                    src="https://static.vecteezy.com/system/resources/previews/019/873/849/original/clock-icon-transparent-free-icon-free-png.png"
                    alt="Generic placeholder image" width="70" height="70">
                <h5>Menunggu Konfirmasi</h5>
                @if ($orders->where('status', 'paid')->count() > 0)
                    <p class="badge badge-dark font-weight-bold">
                        {{ $orders->where('status', 'paid')->count() }}
                        item
                    </p>
                @endif
            </div>
            <div class="col-lg text-center" onclick="detailOrder('delivered')">
                <img class="rounded mb-4" src="https://cdn-icons-png.flaticon.com/512/7615/7615749.png"
                    alt="Generic placeholder image" width="70" height="70">
                <h5>Dikirim</h5>
                @if ($orders->where('status', 'delivered')->count() > 0 || $orders->where('status', 'confirmed')->count() > 0)
                    <p class="badge badge-primary font-weight-bold">
                        {{ $orders->where('status', 'delivered')->count() + $orders->where('status', 'confirmed')->count() }}
                        item
                    </p>
                @endif
            </div>
            <div class="col-lg text-center" onclick="detailOrder('success')">
                <img class="rounded mb-4"
                    src="https://cdn.iconscout.com/icon/free/png-256/free-delivered-2840095-2362633.png"
                    alt="Generic placeholder image" width="70" height="70">
                <h5>Selesai</h5>
                @if ($orders->where('status', 'success')->count() > 0)
                    <p class="badge badge-success font-weight-bold">
                        {{ $orders->where('status', 'success')->count() }} item
                    </p>
                @endif
            </div>
            <div class="col-lg text-center" onclick="detailOrder('failed')">
                <img class="rounded mb-4" src="https://cdn-icons-png.flaticon.com/512/5348/5348886.png"
                    alt="Generic placeholder image" width="70" height="70">
                <h5>Dibatalkan</h5>
                @if ($orders->where('status', 'failed')->count() > 0)
                    <p class="badge badge-danger font-weight-bold">
                        {{ $orders->where('status', 'failed')->count() }} item
                    </p>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Payment -->
    <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="paymentLabel" aria-hidden="true">
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
            function detailOrder(status) {
                $.ajax({
                    url: '{{ route('user-customer.order.filter-status') }}',
                    type: 'GET',
                    data: {
                        status: status
                    },
                    success: function(data) {
                        $('#statusContainer').html(data);
                    }
                });
            }

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
                        $('#paymentMethod').html(data.payment_method == 1 ? 'E-Wallet' : 'COD (Cash On Delivery)');

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
