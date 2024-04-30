@extends('layouts/contentNavbarLayout')

@section('title', ' Tambah Data Barang')

@section('content')
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="py-2 mb-3 text-primary"><span class="text-muted fw-semibold">Form /</span> Tambah Data Barang
                    </h5>
                </div>
                <div class="card-body">
                    <form action="/barang" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nama">Nama Barang <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" class="form-control" id="basic-default-name"
                                    placeholder="Masukkan Nama Barang" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="stok">Stok <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" name="stok" value="0" min="0" class="form-control"
                                    id="basic-default-name" placeholder="Masukkan Stok" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="gambar">Gambar Barang <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="file" name="gambar" class="form-control" accept=".jpg, .png, .jpeg"
                                    id="basic-default-name" />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="text-end">
                                <a href="/barang">
                                    <button type="button" class="btn btn-danger">Kembali</button>
                                </a>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
