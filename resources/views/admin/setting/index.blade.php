@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row pt-4">
                        <div class="col-lg-4">
                            <div class="text-center">
                                <img src="{{ auth()->user()->avatar ? asset('storage/avatar/' . auth()->user()->avatar) : asset('assets/image/defaultuser.jpg') }}"
                                    alt="profile" id="thumbnail" class="img-lg rounded-circle mb-3">
                                <div class="mb-3">
                                    <h4>
                                        {{ Auth::user()->name }}
                                    </h4>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h6 class="mb-0 me-2 text-muted">
                                            {{ Auth::user()->email }}
                                        </h6>
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-2" onclick="changePicture()">
                                    Ubah Foto
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <h4>
                                Informasi Akun
                            </h4>
                            <form action="{{ route('admin.setting.update', auth()->user()->id) }}" method="POST"
                                class="mt-4" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="d-none">
                                    <x-input id="avatar" name="avatar" type="file" label="Foto"
                                        placeholder="Masukkan foto" />
                                </div>
                                <x-input id="name" name="name" type="text" label="Nama"
                                    value="{{ Auth::user()->name }}" placeholder="Masukkan nama" />
                                <div class="form-group row mb-0">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="sex" id="sex1"
                                                    value="1" {{ auth()->user()->sex == 1 ? 'checked' : '' }}>
                                                Pria
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="sex" id="sex2"
                                                    value="2" {{ auth()->user()->sex == 2 ? 'checked' : '' }}>
                                                Wanita
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-input id="phone" name="phone" type="text" placeholder="Nomor Telepon"
                                            value="{{ Auth::user()->phone }}" required />
                                    </div>
                                    <div class="col-md-6">
                                        <x-input id="address" name="address" type="text" placeholder="Alamat"
                                            value="{{ Auth::user()->address }}" required />
                                    </div>
                                </div>
                                <x-input id="email" name="email" type="email" label="Email"
                                    value="{{ Auth::user()->email }}" placeholder="Masukkan email" />
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-input id="password" name="password" type="password" label="Password"
                                            placeholder="Masukkan password" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-input id="password_confirmation" name="password_confirmation" type="password"
                                            label="Konfirmasi Password" placeholder="Masukkan konfirmasi password" />
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js-internal')
        <script>
            function changePicture() {
                $('#avatar').click();

                $('#avatar').change(function() {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#thumbnail').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });
            }

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
