@if ($data->payment_method == 1)
    @if ($data->status == 'paid')
        <div class="dropdown">
            <button class="btn btn-dark py-2 dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="changeStatus"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Ubah Status
            </button>
            <div class="dropdown-menu" aria-labelledby="changeStatus" style="">
                <a class="dropdown-item" href="#" onclick="changeStatus('{{ $data->id }}', 'confirmed')">
                    Konfirmasi
                </a>
                <a class="dropdown-item" href="#" onclick="changeStatus('{{ $data->id }}', 'failed')">
                    Tolak
                </a>
            </div>
        </div>
    @elseif ($data->status == 'confirmed')
        <button class="btn py-2 btn-primary" onclick="changeStatus('{{ $data->id }}', 'delivered')">
            Kirim
        </button>
    @elseif ($data->status == 'delivered')
        <button class="btn py-2 btn-success" onclick="changeStatus('{{ $data->id }}', 'success')">
            Selesai
        </button>
    @endif
@elseif ($data->payment_method == 2)
    @if ($data->status == 'pending')
        <div class="dropdown">
            <button class="btn btn-dark py-2 dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="changeStatus"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Ubah Status
            </button>
            <div class="dropdown-menu" aria-labelledby="changeStatus" style="">
                <a class="dropdown-item" href="#" onclick="changeStatus('{{ $data->id }}', 'delivered')">
                    Diantar
                </a>
                <a class="dropdown-item" href="#" onclick="changeStatus('{{ $data->id }}', 'failed')">
                    Tolak
                </a>
            </div>
        </div>
    @elseif ($data->status == 'delivered')
        <button class="btn btn-primary py-2" onclick="uploadPayment('{{ $data->id }}')">
            Upload Bukti
        </button>
    @endif
@endif
