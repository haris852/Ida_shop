@if ($data->payment_method == 1)
    <a href="{{ asset('storage/payment/' . $data->proof_of_payment) }}" target="_blank">
        <img src="{{ $data->proof_of_payment
            ? asset('storage/payment/' . $data->proof_of_payment)
            : asset('assets/image/defaultmenu.jpg') }}"
            alt="proof" class="img-thumbnail">
    </a>
@else
    <a href="{{ asset('storage/receipt/' . $data->proof_of_receipt) }}" target="_blank">
        <img src="{{ $data->proof_of_receipt
            ? asset('storage/receipt/' . $data->proof_of_receipt)
            : asset('assets/image/defaultmenu.jpg') }}"
            alt="proof" class="img-thumbnail">
    </a>
@endif
