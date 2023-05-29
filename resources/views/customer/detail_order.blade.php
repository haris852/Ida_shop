{{-- back button --}}
<div class="row mb-4 mx-2 justify-content-center">
    <center>
        <a href="{{ route('user-customer.order.index') }}" class="btn btn-dark">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </center>
</div>
<div class="row justify-content-center">
    @if (isset($orders) && count($orders) > 0)
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
                                        {{ $order->payment_method == 1 ? 'E Wallet' : 'COD (Bayar di Tempat)' }}
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
                                        {{ $order->payment_method == 1 ? 'E Wallet' : 'COD (Bayar di Tempat)' }}
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
    @else
        <div class="text-center">
            <h5>
                Tidak ada pesanan
            </h5>
        </div>
    @endif
</div>
