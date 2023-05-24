@extends('guest.layout.master')
@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <h5 class="mb-4">
                                Formulir reset kata sandi
                            </h5>
                            <form action="{{route('reset-password.update')}}" method="POST">
                                @csrf
                                {{-- token --}}
                                <input type="hidden" name="token" value="{{ request()->route('token') }}">
                                {{-- email --}}
                                <x-input id="email" label="Masukan alamat email kamu" name="email" type="email"
                                    required />
                                <x-input id="password" label="Masukan kata sandi baru" name="password" type="password"
                                    required />
                                <x-input id="password_confirmation" label="Masukan ulang kata sandi baru" name="password_confirmation"
                                    type="password" required />
                                <x-button type="submit" class="py-1">
                                    Kirim
                                </x-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js-internal')
        <script>
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ Session::get('success') }}',
                })
            @endif

            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ Session::get('error') }}',
                })
            @endif
        </script>
    @endpush
@endsection
