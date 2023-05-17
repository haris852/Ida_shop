@extends('customer.layout.master')
@section('content')
    <!-- Header -->
    <div class="row d-flex justify-content-between align-items-center">
        <div class="col-md-7">
            <div class="text-wrapper">
                <p class="font-weight-medium">
                    Mulai berbelanja dengan mudah dan nyaman di toko kami!
                </p>
                <h1 class="mbr-section-title mbr-fonts-style display-7 ">
                    <b class="font-weight-bold">
                        Penyedia Daging dan Seafood terbaik di Indonesia
                    </b>
                </h1>
                <p class="mbr-text mbr-fonts-style display-7 w-75">
                    Kami menyediakan berbagai macam daging dan seafood dengan kualitas terbaik dan harga yang terjangkau.
                </p>
                <div class="mbr-section-btn"><a href="#" class="btn btn-primary display-7">Pesan Sekarang</a></div>
            </div>
        </div>
        <div class="d-none d-md-block col-md">
            <img class="w-100" src="{{ asset('customer_asset/img/Fresh Meat 4.png') }}" alt="{{ config('app.name') }}">
        </div>
    </div>

    <!-- Menu -->
    <div class="text-center mt-5 mb-3">
        <h4 class="font-weight-bold">Menu Kami</h4>
        <p>
            Ragam menu yang kami sediakan untuk anda
        </p>
    </div>

    <div class="row mt-5">
        @foreach ($products as $product)
            <div class="col-md-3">
                <div class="card">
                    <img class="card-img object-fit-cover p-2" src="{{ asset('storage/product/' . $product->image) }}"
                        alt="Vans" width="100%" height="200">
                    <div class="card-body">
                        <h6 class="card-title">
                            {{ $product->name }}
                        </h6>
                        <p class="card-subtitle mb-2 text-muted text-capitalize">Kategori: {{ $product->category }}</p>
                        <p class="card-subtitle mb-2 text-muted text-capitalize">Berat: {{ $product->weight }}
                            {{ $product->unit }}</p>
                        <p class="card-subtitle mb-2 text-muted">
                            Stok: {{ $product->stock == 0 ? 'Habis' : $product->stock }}
                        </p>
                        <div>
                            <div class="price">
                                <h5 class="mt-4">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </h5>
                            </div>
                            @auth
                                <div class="">
                                    @if (session()->has('cart.' . $product->id))
                                        <a href="{{ route('cart') }}" class="btn btn-secondary btn-block mt-3" disabled>
                                            <i class="fas fa-shopping-cart mr-1"></i>
                                            Lihat Keranjang
                                        </a>
                                    @else
                                        @if ($product->stock != 0)
                                            <button onclick="addToCart('{{ $product->id }}')"
                                                class="btn btn-block btn-primary mt-3">
                                                {{ __('Tambah ke Keranjang') }}
                                            </button>
                                        @else
                                            <button class="btn btn-block btn-seconday mt-3">
                                                {{ __('Stok Habis') }}
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @push('js-internal')
        <script>
            function addToCart(id) {
                $.ajax({
                    url: "{{ route('cart.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            window.location.href = "{{ route('cart') }}";
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message,
                            });
                        }
                    }
                });
            }
        </script>
    @endpush
@endsection
