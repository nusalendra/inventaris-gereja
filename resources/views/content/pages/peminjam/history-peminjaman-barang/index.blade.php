@extends('layouts/contentNavbarLayout')

@section('title', 'History Peminjaman Barang')

@section('content')
    <div class="card">
        <h5 class="card-header text-dark fw-bold">History Peminjaman Barang</h5>
        <div class="card ps-3 pe-3 pb-3">
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive text-nowrap p-0">
                    <table id="myTable" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">No</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Barang</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Kegiatan</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Tanggal Peminjaman - Pengembalian
                                </th>
                                <th class="text-uppercase text-xs font-weight-bolder">Jumlah</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Lokasi Barang Digunakan</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Status Peminjaman</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Aksi</th>
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
                                                @if ($item->status == 'Belum Dikonfirmasi' || $item->status == 'Ditolak' || $item->status == 'Dibatalkan')
                                                    <h6 class="mb-0 text-sm text-danger">{{ $item->status }}</h6>
                                                @else
                                                    <h6 class="mb-0 text-sm text-primary">{{ $item->status }}</h6>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($item->status == 'Dibatalkan' || $item->status == 'Ditolak')
                                            <div class="col-lg-4 col-md-6">
                                                <div class="px-2 py-1">
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#alasanPembatalanModal{{ $item->id }}">
                                                        Lihat Alasan
                                                    </button>

                                                    <div class="modal fade" id="alasanPembatalanModal{{ $item->id }}"
                                                        aria-labelledby="alasanPembatalanModalLabel{{ $item->id }}"
                                                        tabindex="-1" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title fw-bold"
                                                                        id="alasanPembatalanModalLabel{{ $item->id }}">
                                                                        Alasan
                                                                        Pembatalan / Penolakan Peminjaman Barang
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p class="text-dark fw-semibold">
                                                                        {{ $item->pembatalanPeminjamanBarang->alasan_pembatalan }}

                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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
            </div>
        </div>
    </div>
@endsection
