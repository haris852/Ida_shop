@extends('customer.layout.master')
@section('content')
    @if (!$isOpen)
        <div class="row justify-content-center mt-5">
            <div class="alert alert-danger col-md" role="alert">
                <i class="fas fa-clock mr-2"></i>
                <strong>Toko Tutup</strong>
                <p class="mb-0">
                    Toko akan buka kembali pada pukul {{ $openTime }}
                </p>
            </div>
        </div>
    @endif

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
                <div class="mbr-section-btn"><a href="{{ route('menu') }}" class="btn btn-primary display-7">Pesan
                        Sekarang</a>
                </div>
            </div>
        </div>
        <div class="d-none d-md-block col-md">
            <img class="w-100" src="{{ asset('customer_asset/img/Fresh Meat 4.png') }}" alt="{{ config('app.name') }}">
        </div>
    </div>

    <!-- Menu -->
    <div class="text-center mt-5 mb-3">
        <h4 class="font-weight-bold">Produk</h4>
        <p>
            Produk yang kami sediakan
        </p>
    </div>

    <div class="row mt-5">
        @foreach ($products as $product)
            <div class="col-md-3" data-name="{{ $product->name }}" data-weight="{{ $product->weight }} {{ $product->unit }}"
                data-stock="{{ $product->stock == 0 ? 'Habis' : $product->stock }}"
                data-description="{{ $product->description }}" id="{{ $product->id }}">
                <div class="card">
                    <img class="card-img object-fit-cover p-2" src="{{ asset('storage/product/' . $product->image) }}"
                        alt="product image" width="100%" height="200">
                    <div class="card-body">
                        <h6 class="card-title pointer" onclick="detailProduct('{{ $product->id }}')">
                            {{ $product->name }} <i class="fas fa-info-circle fa-xs text-primary ml-2"></i>
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
                            <div class="">
                                @if (session()->has('cart.' . $product->id))
                                    <a href="{{ route('cart') }}" class="btn btn-secondary btn-block mt-3" disabled>
                                        <i class="fas fa-shopping-cart mr-1"></i>
                                        Lihat Keranjang
                                    </a>
                                @else
                                    @if ($product->stock != 0)
                                        <a @if (auth()->check()) onclick="addToCart('{{ $product->id }}')"
                                                @else
                                                href="{{ route('login') }}" @endif
                                            class="btn btn-block text-white btn-primary mt-3">
                                            {{ __('Tambah ke Keranjang') }}
                                        </a>
                                    @else
                                        <button class="btn btn-block btn-seconday mt-3">
                                            {{ __('Stok Habis') }}
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal Detail Product -->
    <div class="modal fade" id="detailProductModal" tabindex="-1" role="dialog" aria-labelledby="detailProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="detailProductModalLabel">Detail Produk</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-lg-flex mb-1 justify-content-between">
                        <span class="text-gray">Nama Produk</span>
                        <span class="product-name">-</span>
                    </div>
                    <div class="d-lg-flex mb-1 justify-content-between">
                        <span class="text-gray">Berat</span>
                        <span class="product-weight">-</span>
                    </div>
                    <div class="d-lg-flex mb-1 justify-content-between">
                        <span class="text-gray">Stok</span>
                        <span class="product-stock">-</span>
                    </div>
                    <div class="d-lg-flex mb-1 justify-content-between">
                        <span class="text-gray">Deskripsi</span>
                        <p class="product-description">-</p>
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
            function detailProduct(id) {
                $('#detailProductModal').modal('show');
                $('.product-name').text($('#' + id).data('name'));
                $('.product-weight').text($('#' + id).data('weight'));
                $('.product-stock').text($('#' + id).data('stock'));
                $('.product-description').text($('#' + id).data('description') || '-');
            }

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
                            location.reload();
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

            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: "{{ Session::get('success') }}"
                });
            @endif

            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: "{{ Session::get('error') }}"
                });
            @endif
        </script>
    @endpush
@endsection
