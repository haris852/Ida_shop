@if ($data->status == 'pending')
    <span class="badge badge-warning">Menunggu Pembayaran</span>
@elseif ($data->status == 'paid')
    <span class="badge badge-primary">Menunggu Konfirmasi</span>
@elseif ($data->status == 'confirmed')
    <span class="badge badge-primary">Pesanan Dikonfirmasi</span>
@elseif ($data->status == 'delivered')
    <span class="badge badge-success">Pesanan Dikirim</span>
@elseif ($data->status == 'success')
    <span class="badge badge-success">Pesanan Selesai</span>
@endif
