@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('content')
    <div class="row mb-5">
        @foreach ($data as $item)
            <div class="col-md-3 col-lg-3 mb-3">
                <div class="card h-100 d-flex flex-column">
                    <img class="card-img-top" src="/gambar-barang/{{ $item->gambar }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title text-dark fw-semibold">{{ $item->nama }}</h5>
                        <p>Stok Barang Tersedia : {{ $item->stok }}</p>

                        @php
                            $peminjaman = App\Models\Peminjaman::where('barang_id', $item->id)
                                ->where('user_id', Auth::user()->id)
                                ->exists();

                            $peminjamanHariIni = App\Models\Peminjaman::whereDate('created_at', $tanggalSekarang)
                                ->where('user_id', Auth::user()->id)
                                ->whereIn('status', ['Belum Dikonfirmasi', 'Dikonfirmasi'])
                                ->count();

                            $dataPeminjaman = App\Models\Peminjaman::where('barang_id', $item->id)
                                ->where('user_id', Auth::user()->id)
                                ->get();
                        @endphp
                        @if (!$peminjaman)
                            @if ($peminjamanHariIni >= 2)
                                <button type="button" class="btn btn-outline-primary mt-auto" data-bs-toggle="modal"
                                    data-bs-target="#modalToggle2">Pinjam Barang</button>
                            @else
                                <a href="/form-peminjaman-barang/{{ $item->id }}"
                                    class="btn btn-outline-primary mt-auto">Pinjam Barang</a>
                            @endif
                        @else
                            @php
                                $setButtonLebihDariSatu = false;
                            @endphp

                            @foreach ($dataPeminjaman as $peminjaman)
                                @if ($peminjaman->status == 'Belum Dikonfirmasi' && !$setButtonLebihDariSatu)
                                    @php
                                        $setButtonLebihDariSatu = true;
                                    @endphp
                                    <button type="button" class="fw-semibold btn btn-primary">Permintaan
                                        Peminjaman</button>
                                @elseif ($peminjaman->status == 'Dikonfirmasi' && !$setButtonLebihDariSatu)
                                    @php
                                        $setButtonLebihDariSatu = true;
                                    @endphp
                                    <button type="button" class="fw-semibold btn btn-danger">Barang sedang
                                        dipinjam</button>
                                @else
                                    @if ($peminjamanHariIni >= 2)
                                        <button type="button" class="btn btn-outline-primary mt-auto"
                                            data-bs-toggle="modal" data-bs-target="#modalToggle2">Pinjam Barang</button>
                                    @else
                                        <a href="/form-peminjaman-barang/{{ $item->id }}"
                                            class="btn btn-outline-primary mt-auto">Pinjam Barang</a>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Modal --}}
        <div class="modal fade" id="modalToggle2" aria-hidden="true" aria-labelledby="modalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="modalToggleLabel2">Penolakan Peminjaman Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-dark fw-semibold">Maaf, peminjaman barang anda ditolak. Setiap peminjam dibatasi
                            untuk
                            meminjam maksimal 2 barang
                            dalam 1 hari. Terima kasih atas pengertian Anda.</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-target="#modalToggle" data-bs-toggle="modal"
                            data-bs-dismiss="modal">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
