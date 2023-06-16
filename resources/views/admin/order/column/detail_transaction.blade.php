<table class="table table-select">
    <thead>
        <tr>
            <th>#</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data->transactionDetail as $transaction)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ $transaction->product->name }}
                </td>
                <td>
                    {{ $transaction->qty }}
                </td>
                <td>
                    {{ $transaction->price }}
                </td>
                <td>
                    {{ $transaction->total_price }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
