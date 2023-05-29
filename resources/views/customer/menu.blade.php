@extends('customer.layout.master')
@section('content')
    <!-- Menu -->
    <div class="text-center mt-5 mb-3">
        <h4 class="font-weight-bold">Produk</h4>
        <p>
            Ragam menu yang kami sediakan untuk anda
        </p>
    </div>

    <div class="row mt-5">
        <div class="col-md-2"></div>
        <div class="col-md-2 mb-3">
            <div class="dropdown">
                <button class="btn btn-block btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Kategori Produk
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('menu') }}">Semua</a>
                    @foreach ($categories as $category => $value)
                        <a class="dropdown-item" onclick="sortCategory('{{ $value->category }}')">
                            {{ ucfirst($value->category) }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <form action="{{ route('menu') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Cari Menu">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-5">
        @foreach ($products as $product)
            <div class="col-md-3" id="menuItem">
                <div class="card">
                    <img class="card-img object-fit-cover p-2" src="{{ asset('storage/product/' . $product->image) }}"
                        alt="Vans" width="100%" height="200">
                    <div class="card-body">
                        <h6 class="card-title">
                            {{ $product->name }}
                        </h6>
                        <p class="card-subtitle mb-2 text-muted text-capitalize" id="categoryLabel">Kategori: {{ $product->category }}</p>
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

    @push('js-internal')
        <script>

            function sortCategory(category) {
                // filter menuItem berdasarkan category
                $('.col-md-3#menuItem').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(category) > -1)
                });
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

            $(function () {
                $('input[name="search"]').on('keyup', function () {
                    let value = $(this).val().toLowerCase();
                    $('#menuItem.col-md-3').filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
    @endpush
@endsection
