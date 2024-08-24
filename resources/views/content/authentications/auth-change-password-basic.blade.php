@extends('layouts/contentNavbarLayout')

@section('title', 'Ubah Password')

@section('content')
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="py-2 text-dark">Ubah Password</h5>
                </div>
                <div class="card-body">
                    <form action="/ubah-password" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="password_lama">Password Lama</label>
                            <div class="col-sm-10">
                                <input type="password" name="password_lama" class="form-control" id="basic-default-name"
                                    placeholder="Masukkan Password Lama" required/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="password_baru">Password Baru</label>
                            <div class="col-sm-10">
                                <input type="password" name="password_baru" class="form-control" id="basic-default-name"
                                    placeholder="Masukkan Password Baru" required/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="konfirmasi_password_baru">Konfirmasi Password Baru</label>
                            <div class="col-sm-10">
                                <input type="password" name="konfirmasi_password_baru" class="form-control" id="basic-default-name"
                                    placeholder="Tulis Ulang Password Baru" required/>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Proses</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('error'))
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error'
            });
        @elseif (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success'
            });
        @endif
    </script>
@endsection
