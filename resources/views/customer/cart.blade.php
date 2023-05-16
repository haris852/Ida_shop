@extends('customer.layout.master')
@section('content')
    <div class="py-5 text-center">
        <h4>
            {{-- <i class="fas fa-shopping-cart mr-3 text-primary"></i> --}}
            Keranjang
        </h4>
        <p class="mt-2">
            <span class="text-danger">*</span>Item yang ada pada keranjang anda akan kadaluarsa dalam waktu 1 hari
        </p>
    </div>

    <div class="border-bottom mb-3 my-5"></div>
    <div class="row my-5">
        <div class="col-md-8">
            <ul class="list-group list-group-flush">
                @forelse ($carts as $cart)
                    <li class="list-group-item py-3 ps-0" data-id="{{ $cart['id'] }}" data-price="{{ $cart['price'] }}">
                        <!-- row -->
                        <div class="row align-items-center">
                            <div class="col-3 col-md-2">
                                <!-- img --> <img src="{{ asset('storage/product/' . $cart['image']) }}" alt="Ecommerce"
                                    class="img-fluid">
                            </div>
                            <div class="col-4 col-md-6 col-lg-5">
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
                            <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                                <span class="fw-bold">Rp. <span class="subTotal">{{$cart['subtotal']}}</span></span>

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
        <div class="col-md">
            <p class="font-weight-bold mb-4">
                Detail Pemesanan
            </p>
            <form action="" method="POST">
                @csrf
                <x-textarea id="address" name="address" label="Alamat" placeholder="Masukkan alamat lengkap anda"
                    value="{{ old('address') }}" />
            </form>
        </div>
    </div>

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
                // get value if quantity stop change
                $('input[name="quantity"]').on('input', function() {
                    if($(this).val() == 0) {
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
