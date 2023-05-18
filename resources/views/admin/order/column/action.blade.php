@if ($data->payment_method == 1)
    @if ($data->status == 'paid')
        <button class="btn btn-dark py-2" onclick="changeStatus('{{ $data->id }}', 'confirmed')">
            Konfirmasi
        </button>
    @elseif ($data->status == 'confirmed')
        <button class="btn btn-primary" onclick="changeStatus('{{ $data->id }}', 'delivered')">
            Kirim
        </button>
    @elseif ($data->status == 'delivered')
        <button class="btn btn-success" onclick="changeStatus('{{ $data->id }}', 'success')">
            Selesai
        </button>
    @endif
@elseif ($data->payment_method == 2)
    <button class="btn btn-success py-2" onclick="changeStatus('{{ $data->id }}', 'success')">
        Selesai
    </button>
@endif
