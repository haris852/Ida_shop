@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.store-configuration.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <x-input id="code" name="code" type="text" label="Kode Toko" :value="$data->code"
                                    disabled />
                                <x-input id="name" name="name" type="text" label="Nama Toko" :value="$data->name"
                                    required />
                                <x-input id="phone" name="phone" type="text" label="No. Telepon" :value="$data->phone"
                                    required />
                            </div>
                            <div class="col-md-6">
                                <x-input id="email" name="email" type="email" label="Email" :value="$data->email"
                                    required />
                                <x-input id="open_at" name="open_at" type="time" label="Jam Buka" :value="$data->open_at"
                                    required />
                                <x-input id="close_at" name="close_at" type="time" label="Jam Tutup" :value="$data->close_at"
                                    required />
                            </div>
                        </div>
                        <x-input id="shipping_cost" name="shipping_cost" type="number" label="Biaya Pengiriman"
                            :value="$data->shipping_cost" required />
                        <x-textarea id="address" name="address" label="Alamat" :value="$data->address" required />
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('js-internal')
        <script>
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    text: '{{ Session::get('success') }}',
                })
            @endif

            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    text: '{{ Session::get('error') }}',
                })
            @endif
        </script>
    @endpush
@endsection
