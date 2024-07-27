@extends('layouts/contentNavbarLayout')

@section('title', 'Proses Peminjaman Barang')

@section('content')
    <div class="card">
        <h5 class="card-header text-dark fw-bold">Proses Peminjaman Barang</h5>
        <div class="card ps-3 pe-3 pb-3">
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive text-nowrap p-0">
                    <table id="myTable" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">No</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Barang</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Kegiatan</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Tgl Pengajuan</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Tgl Peminjaman - Pengembalian</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Jmlh</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Lokasi Brg</th>
                                <th class="text-uppercase text-xs font-weight-bolder">Status Pinjam</th>
                                <th class="text-uppercase text-xs font-weight-bolder"></th>
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
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                                </h6>
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
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                @if ($item->status == 'Belum Dikonfirmasi')
                                                    <h6 class="mb-0 text-sm text-danger">{{ $item->status }}</h6>
                                                @else
                                                    <h6 class="mb-0 text-sm text-primary">{{ $item->status }}</h6>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    @if ($item->status == 'Dikonfirmasi')
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <form action="unduh-bukti-peminjaman-barang/{{ $item->id }}"
                                                        method="POST" role="form text-left">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary" value="Dikonfirmasi"
                                                            name="status">
                                                            Unduh Bukti Peminjaman
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
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
