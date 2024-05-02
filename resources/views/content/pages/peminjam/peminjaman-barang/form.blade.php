@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="py-2 text-dark">Peminjaman Barang {{ $barang->nama }}</h5>
                </div>
                <div class="card-body">
                    <form action="/peminjaman-barang" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $barang->id }}" name="barang_id">
                        <div class="mb-3">
                            <label class="form-label" for="jumlah">Jumlah Peminjaman</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah"
                                placeholder="Berapa Jumlah Dibutuhkan ?" value="1" min="0" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tanggal_peminjaman">Tanggal Peminjaman</label>
                            <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman"
                                required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tanggal_pengembalian">Tanggal Pengembalian</label>
                            <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian"
                                required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="lokasi_barang">Lokasi Barang Digunakan</label>
                            <input type="text" class="form-control" id="lokasi_barang" name="lokasi_barang"
                                placeholder="Dimana Lokasi Barang Digunakan ?" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="kategori_id">Peminjaman Barang Untuk Kegiatan</label>
                            <select class="form-select" name="kategori_id" aria-label="Default select example" required>
                                <option selected>Pilih Kegiatan</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex">
                            <a href="/peminjaman-barang">
                                <button type="button" class="btn btn-danger">Kembali</button>
                            </a>
                            <button type="submit" class="btn btn-primary ms-2">Kirim Permintaan Peminjaman</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
