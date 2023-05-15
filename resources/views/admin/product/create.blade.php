@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.product.store')}}" method="POST">
                        @csrf
                        <x-input id="name" name="name" type="text" label="Nama" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
