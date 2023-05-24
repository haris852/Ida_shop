@extends('customer.layout.master')
@section('content')
    <div class="pt-5 pb-3 text-center">
        <h4>
            {{-- <i class="fas fa-shopping-cart mr-3 text-primary"></i> --}}
            Keranjang
        </h4>
        <p class="mt-2">
            <span class="text-danger">*</span>Item yang ada pada keranjang anda akan kadaluarsa dalam waktu 1 hari
        </p>
    </div>
    @if (!$isOpen)
        <div class="row justify-content-center">
            <div class="alert alert-danger col-md-6" role="alert">
                <i class="fas fa-clock mr-2"></i>
                <strong>Toko Tutup</strong>
                <p class="mb-0">
                    Toko akan buka kembali pada pukul {{ $openTime }}
                </p>
            </div>
        </div>
    @endif

    <div class="border-bottom mb-3 my-5"></div>
    @if (isset($carts) && count($carts) > 0)
        <div class="row my-5">
            <div class="col-md-7">
                <ul class="list-group list-group-flush">
                    @forelse ($carts as $cart)
                        <li class="list-group-item py-3 ps-0 cart-item" data-id="{{ $cart['id'] }}"
                            data-price="{{ $cart['price'] }}">
                            <!-- row -->
                            <div class="row align-items-center">
                                <div class="col-2 col-md-2">
                                    <!-- img --> <img src="{{ asset('storage/product/' . $cart['image']) }}" alt="Ecommerce"
                                        class="img-fluid">
                                </div>
                                <div class="col-4 col-md-5 col-lg-4">
                                    <!-- title -->
                                    <span class="">
                                        <h6 class="mb-0 font-weight-bold">
                                            {{ $cart['name'] }}
                                        </h6>
                                    </span>
                                    <span>
                                        <small class="text-muted">
                                            {{ $cart['weight'] . ' / ' . $cart['unit'] }} — Rp
                                            {{ number_format($cart['price'], 0, ',', '.') }}
                                        </small>
                                    </span>
                                    <!-- text -->
                                    <div class="mt-2 small lh-1"> <a type="button"
                                            onclick="deleteItemCart('{{ $cart['id'] }}')" href="#!"
                                            class="text-decoration-none text-inherit">
                                            <span class="me-1 align-text-bottom">
                                                <i class="fas fa-trash-alt text-danger mr-2"></i>
                                            </span><span class="text-muted">Hapus</span></a></div>
                                </div>
                                <!-- input group -->
                                <div class="col-3 col-md-3 col-lg-3">
                                    <!-- input -->
                                    <div class="input-group input-spinner  ">
                                        <input type="number" value="1" min="1" data-id="{{ $cart['id'] }}"
                                            name="quantity" class="form-control">
                                    </div>

                                </div>
                                <!-- price -->
                                <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                    <span class="fw-bold">Rp. <span class="subTotal">{{ $cart['subtotal'] }}</span></span>

                                </div>
                            </div>
                        </li>
                    @empty
                        <center>
                            <div class="block">
                                <p class="text-center">
                                    Sepertinya anda belum memesan apapun
                                </p>
                                <a href="{{ route('home') }}" class="btn btn-primary btn-sm">Lanjutkan Belanja</a>
                            </div>
                        </center>
                    @endforelse
                </ul>
            </div>
            <div class="col-md mt-3 mt-md-0">
                <p class="font-weight-bold mb-4">
                    Detail Pemesanan
                </p>
                <x-textarea id="address" name="address" label="Alamat" placeholder="Nama dusun, RT, RW, Nomor Rumah"
                    required value="{{ old('address') }}" />
                <small class="text-secondary d-block mb-3">
                    <span class="text-danger">*</span>
                    Silahkan isi alamat dengan lengkap dan jelas
                </small>
                <x-textarea id="note" name="note" label="Catatan" placeholder="Catatan tambahan"
                    value="{{ old('note') }}" />
                <div class="row">
                    <div class="col-md-6">
                        <x-input id="receiver_phone" name="receiver_phone" label="Nomor Telepon Penerima" type="number"
                            required value="{{ old('receiver_phone') }}" />
                    </div>
                    <div class="col-md-6">
                        <x-input id="receiver_name" name="receiver_name" label="Nama Penerima" type="text" required
                            value="{{ old('receiver_name') }}" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="payment_method">Metode Pembayaran</label>
                    <select class="form-control text-sm" name="payment_method" id="payment_method">
                        {{-- e money, COD --}}
                        <option value="1">E-Money</option>
                        <option value="2">COD</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a class="btn btn-light" href="{{ route('home') }}">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                    @if ($isOpen && count($carts) > 0)
                        <button class="btn btn-primary" id="btnCheckout">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Pesan Sekarang
                        </button>
                    @else
                        <button class="btn btn-primary" disabled>
                            <i class="fas fa-clock mr-2"></i>
                            Toko Tutup
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @else
        <center>
            <div class="block">
                <p class="text-center">
                    Sepertinya anda belum memesan apapun
                </p>
                <a href="{{ route('home') }}" class="btn btn-primary btn-sm">Lanjutkan Belanja</a>
            </div>
        </center>
    @endif
    @push('js-internal')
        <script>
            function deleteItemCart(id) {
                let carts = @json($carts);
                if (carts.length == 0) {
                    window.location.href = "{{ route('home') }}"
                } else {
                    $.ajax({
                        url: "{{ route('cart.destroy') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id
                        },
                        success: function(response) {
                            if (response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Berhasil menghapus item dari keranjang',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    })
                }
            }

            $(function() {

                $('#btnCheckout').click(function(e) {
                    e.preventDefault();
                    let carts = @json($carts);
                    let cartItem = $('.cart-item');
                    let subTotal = 0;
                    let total = 0;

                    cartItem.each(function() {
                        let id = $(this).data('id');
                        let quantity = $(this).find('input[name="quantity"]').val();
                        let subTotalItem = parseInt($(this).find('.subTotal').text());

                        subTotal += subTotalItem;
                        total += subTotalItem;

                        Object.keys(carts).forEach(function(key) {
                            if (carts[key].id == id) {
                                carts[key].quantity = quantity;
                                carts[key].subtotal = subTotalItem;
                            }
                        });
                    });

                    let address = $('#address').val();
                    let receiver_name = $('#receiver_name').val();
                    let receiver_phone = $('#receiver_phone').val();
                    let payment_method = $('#payment_method').val();
                    let note = $('#note').val();

                    if (address == '' || receiver_name == '' || receiver_phone == '') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Mohon isi semua form dengan benar',
                        });
                    } else {
                        $.ajax({
                            url: "{{ route('customer.checkout.store') }}",
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                carts: carts,
                                address: address,
                                note: note,
                                receiver_name: receiver_name,
                                receiver_phone: receiver_phone,
                                payment_method: payment_method,
                                subTotal: subTotal,
                                total: total
                            },
                            success: function(response) {
                                if (response.status == 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function() {
                                        window.location.href = "{{ route('home') }}"
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: response.message,
                                    });
                                }
                            }
                        });
                    }
                });

                // get value if quantity stop change
                $('input[name="quantity"]').on('input', function() {
                    if ($(this).val() == 0) {
                        $(this).closest('li').find('.subTotal').text(0);
                    }

                    let val = $(this).val() == '' ? 0 : $(this).val();
                    let cart = $(this).data('id');
                    let price = $(this).closest('li').data('price');
                    let subTotal = val * price;
                    $(this).closest('li').find('.subTotal').text(subTotal);
                });
            });
        </script>
    @endpush
@endsection
