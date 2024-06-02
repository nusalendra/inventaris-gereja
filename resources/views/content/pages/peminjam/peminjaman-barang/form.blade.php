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
                <form action="/peminjaman-barang" method="POST" onsubmit="return validateDates(event)">
                    @csrf
                    <input type="hidden" value="{{ $barang->id }}" name="barang_id">
                    <input type="hidden" id="hari_batas_peminjaman" name="hari_batas_peminjaman" value="{{ $barang->hari_batas_peminjaman }}">
                    <div class="mb-3">
                        <label class="form-label" for="jumlah">Jumlah Peminjaman</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah"
                               placeholder="Berapa Jumlah Dibutuhkan ?" value="1" min="0" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tanggal_peminjaman">Tanggal Peminjaman</label>
                        <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman" required min="{{ date('Y-m-d') }}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tanggal_pengembalian">Tanggal Pengembalian</label>
                        <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" required min="{{ date('Y-m-d') }}" />
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
                <div class="modal fade" id="modalTanggalPeminjamanPengembalian" aria-hidden="true" aria-labelledby="modalToggleLabel2" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-danger" id="modalToggleLabel2">Penolakan Peminjaman Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-dark fw-semibold">Maaf, tanggal pengembalian tidak boleh sebelum tanggal peminjaman atau melebihi batas hari peminjaman</p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>                    
            </div>
        </div>
    </div>
</div>
<script>
    function validateDates(event) {
        const tanggalPeminjaman = document.getElementById('tanggal_peminjaman').value;
        const tanggalPengembalian = document.getElementById('tanggal_pengembalian').value;
        const hariBatasPeminjaman = parseInt(document.getElementById('hari_batas_peminjaman').value, 10);

        const tanggalPeminjamanDate = new Date(tanggalPeminjaman);
        const tanggalPengembalianDate = new Date(tanggalPengembalian);

        // Periksa jika tanggal pengembalian sebelum tanggal peminjaman
        if (tanggalPengembalianDate < tanggalPeminjamanDate) {
            event.preventDefault(); 
            var myModal = new bootstrap.Modal(document.getElementById('modalTanggalPeminjamanPengembalian'), {});
            myModal.show();
            return false;
        }

        // Hitung selisih hari
        const timeDiff = tanggalPengembalianDate.getTime() - tanggalPeminjamanDate.getTime();
        const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Konversi milidetik ke hari

        // Periksa jika selisih hari melebihi batas
        if (daysDiff > hariBatasPeminjaman) {
            event.preventDefault();
            var myModal = new bootstrap.Modal(document.getElementById('modalTanggalPeminjamanPengembalian'), {});
            myModal.show();
            return false;
        }

        return true;
    }
</script>
@endsection
