@extends('layouts/contentNavbarLayout')

@section('title', ' Edit Data Kategori')

@section('content')
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="py-2 mb-3 text-primary"><span class="text-muted fw-semibold">Form /</span> Edit Data Kategori
                    </h5>
                </div>
                <div class="card-body">
                    <form action="/kategori/{{ $data->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nama">Nama Kategori <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" value="{{ $data->nama }}" class="form-control"
                                    id="basic-default-name" placeholder="Masukkan Nama Kategori" />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="text-end">
                                <a href="/kategori">
                                    <button type="button" class="btn btn-danger">Kembali</button>
                                </a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
