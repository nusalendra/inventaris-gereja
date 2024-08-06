@extends('layouts/contentNavbarLayout')

@section('title', 'Peminjaman Barang Dikonfirmasi')

@section('content')
    <div class="card">
        <h5 class="card-header text-dark fw-bold">Peminjaman Barang Dikonfirmasi</h5>
        <div class="card ps-3 pe-3 pb-3">
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive text-nowrap p-0">
                    <table id="myTable" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">No</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Peminjam</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Barang</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Kegiatan</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Tgl Peminjaman - Pengembalian</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Jml</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Lokasi Barang</th>
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
                                                @php
                                                    $userName = $item->user->name;
                                                    $maxLength = 12;
                                                    if (strlen($userName) > $maxLength) {
                                                        $userName = substr($userName, 0, $maxLength) . '...';
                                                    }
                                                @endphp
                                                <h6 class="mb-0 text-sm">{{ $userName }}</h6>
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
                                                @php
                                                    $lokasiBarang = $item->lokasi_barang;
                                                    $maxLength = 12;
                                                    if (strlen($lokasiBarang) > $maxLength) {
                                                        $lokasiBarang = substr($lokasiBarang, 0, $maxLength) . '...';
                                                    }
                                                @endphp
                                                <h6 class="mb-0 text-sm">{{ $lokasiBarang }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-1 py-1">
                                            <form class="pengembalianForm" action="/pengembalian-barang/{{ $item->id }}"
                                                method="POST" data-image-url="{{ $item->bukti_pengembalian_barang }}">
                                                @csrf
                                                @method('put')
                                                <div class="ms-2 d-flex flex-column justify-content-center">
                                                    <button type="submit" class="btn btn-primary">
                                                        Konfirmasi Pengembalian
                                                    </button>
                                                </div>
                                            </form>
                                            @php
                                                $tanggalSekarang = \Carbon\Carbon::now()->startOfDay();
                                                $tanggalPeminjaman = \Carbon\Carbon::parse($item->tanggal_peminjaman);
                                                $selisihHari = $tanggalSekarang->diffInDays($tanggalPeminjaman);
                                            @endphp
                                            @if ($selisihHari > 2 && $item->status !== 'Dikembalikan')
                                                <form action="/alasan-pembatalan-barang/{{ $item->id }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="ms-2 d-flex flex-column justify-content-center">
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#modalPembatalanBarang">
                                                            Batalkan Peminjaman
                                                        </button>
                                                        <div class="modal fade" id="modalPembatalanBarang" tabindex="-1"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="modalPembatalanBarangTitle">
                                                                            Pembatalan Peminjaman Barang</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col mb-3">
                                                                                <label for="nameWithTitle"
                                                                                    class="form-label">Alasan Pembatalan
                                                                                    Barang</label>
                                                                                <input type="text" id="nameWithTitle"
                                                                                    class="form-control"
                                                                                    name="alasan_pembatalan"
                                                                                    placeholder="Berikan Alasan Pembatalan">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <style>
                        .swal2-container {
                            z-index: 2000 !important;
                        }

                        .swal2-container.swal2-shown .navbar,
                        .swal2-container.swal2-shown .sidebar {
                            visibility: hidden;
                        }
                    </style>
                    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                    <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        let table = new DataTable('#myTable');

                        document.querySelectorAll('.pengembalianForm').forEach(function(form) {
                            form.addEventListener('submit', function(event) {
                                event.preventDefault();
                                const imageUrl = form.getAttribute(
                                'data-image-url');

                                Swal.fire({
                                    title: "Bukti Pengembalian Barang",
                                    text: "Periksa kembali bahwa barang telah diterima. Klik 'Konfirmasi Pengembalian' untuk mengkonfirmasi.",
                                    imageUrl: 'bukti-pengembalian-barang/' + imageUrl,
                                    imageWidth: 900,
                                    imageHeight: 450,
                                    width: '1000px',
                                    padding: '1em',
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Konfirmasi Pengembalian",
                                    onBeforeOpen: () => {
                                        document.querySelector('.navbar').style.visibility = 'hidden';
                                        document.querySelector('.sidebar').style.visibility = 'hidden';
                                    },
                                    onClose: () => {
                                        document.querySelector('.navbar').style.visibility = '';
                                        document.querySelector('.sidebar').style.visibility = '';
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        form.submit();
                                    }
                                });
                            });
                        });
                    </script>
                </div>

            </div>
        </div>
    </div>
@endsection
