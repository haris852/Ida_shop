@if ($data->status == 'pending')
    <button class="btn btn-rounded btn-dark btn-sm">
        {{$data->payment_method == 1 ? 'Menunggu Pembayaran' : 'Menunggu Penerimaan'}}
    </button>
@elseif ($data->status == 'paid')
    <button class="btn btn-rounded btn-warning btn-sm">Pesanan Dibayar</button>
@elseif ($data->status == 'confirmed')
    <button class="btn btn-rounded btn-info btn-sm">Pesanan Dikonfirmasi</button>
@elseif ($data->status == 'delivered')
    <button class="btn btn-rounded btn-secondary btn-sm">Pesanan Dikirim</button>
@elseif ($data->status == 'success')
    <button class="btn btn-rounded btn-success btn-sm">Pesanan Selesai</button>
@elseif ($data->status == 'failed')
    <button class="btn btn-rounded btn-danger btn-sm">Pesanan Ditolak</button>
@endif
