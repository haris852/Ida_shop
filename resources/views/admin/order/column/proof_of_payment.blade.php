<img src="{{
    $data->proof_of_payment
        ? asset('storage/payment/' . $data->proof_of_payment)
        : asset('assets/image/defaultmenu.jpg')
}}" alt="proof" class="img-thumbnail">
