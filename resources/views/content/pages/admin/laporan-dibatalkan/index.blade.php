@extends('layouts/contentNavbarLayout')

@section('title', 'Laporan Peminjaman Barang Dibatalkan / Ditolak')

@section('content')
    <div class="card">
        <h5 class="card-header text-dark fw-bold">Laporan Peminjaman Barang Dibatalkan / Ditolak</h5>
        <div class="card ps-3 pe-3 pb-3">
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive text-nowrap p-0">
                    <table id="myTable" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">No</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Nama Penanggung Jawab</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Nama Barang</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Untuk Kegiatan</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Tanggal Peminjaman - Pengembalian</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Jumlah</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Lokasi Barang Digunakan</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $item)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $index + 1 }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $item->user->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $item->barang->nama }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $item->kategori->nama }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">
                                                    {{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d-m-Y') }}
                                                    s/d
                                                    {{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->format('d-m-Y') }}
                                                    ({{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->diffInDays($item->tanggal_pengembalian) }}
                                                    hari)
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $item->jumlah }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $item->lokasi_barang }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $item->status }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                    <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
                    <script>
                        let table = new DataTable('#myTable');
                    </script>
                </div>
                <div class="modal fade" id="modalJumlahLebihDariStok" aria-hidden="true" aria-labelledby="modalToggleLabel2"
                    tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-danger" id="modalToggleLabel2">Permintaan Peminjaman Barang
                                    Melebihi Stok Tersedia</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-dark fw-semibold">Mohon maaf, permintaan peminjaman melebihi ketersediaan
                                    stok barang saat ini. Kami memohon agar segera mengembalikan barang yang dipinjam untuk
                                    menyesuaikan stok dengan permintaan.</p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" data-bs-target="#modalToggle" data-bs-toggle="modal"
                                    data-bs-dismiss="modal">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
