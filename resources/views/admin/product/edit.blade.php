@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <x-input id="name" type="text" name="name" label="Nama Produk" :value="$data->name" />
                            <x-input id="weight" type="number" name="weight" label="Berat (gram)"
                                :value="$data->weight" />
                            <x-input id="stock" type="number" name="stock" label="Stok" :value="$data->stock" />
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
