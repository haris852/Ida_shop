@if ($data->status == 'pending')
    <!-- expired -->
    @if ($data->created_at->addMinutes(60) < now())
        <button class="btn btn-rounded btn-danger btn-sm text-white">Pesanan Kadaluarsa</button>
    @else
    <button class="btn btn-rounded btn-dark btn-sm text-white">
        {{$data->payment_method == 1 ? 'Menunggu Pembayaran' : 'Menunggu Penerimaan'}}
    </button>
    @endif
@elseif ($data->status == 'paid')
    <button class="btn btn-rounded btn-warning btn-sm">Pesanan Dibayar</button>
@elseif ($data->status == 'confirmed')
    <button class="btn btn-rounded btn-info btn-sm">Pesanan Dikonfirmasi</button>
@elseif ($data->status == 'delivered')
    <button class="btn btn-rounded btn-secondary btn-sm">Pesanan Dikirim</button>
@elseif ($data->status == 'success')
    <button class="btn btn-rounded btn-success text-white btn-sm">Pesanan Selesai</button>
@elseif ($data->status == 'failed')
    <button class="btn btn-rounded btn-danger text-white border-none outline-none btn-sm">Pesanan Ditolak</button>
@endif
