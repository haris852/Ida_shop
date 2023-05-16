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
                                <x-input id="code" name="code" label="Kode Toko" :value="$data->code" disabled />
                                <x-input id="name" name="name" label="Nama Toko" :value="$data->name" required />
                                <x-input id="phone" name="phone" label="No. Telepon" :value="$data->phone" required />
                                <x-input id="address" name="address" label="Alamat" :value="$data->address" required />
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
