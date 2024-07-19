@foreach ($data as $item)
    <div class="col-md-3 col-lg-3 mb-3">
        <div class="card h-100 d-flex flex-column">
            <img class="card-img-top" src="/gambar-barang/{{ $item->gambar }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title text-dark fw-semibold">{{ $item->nama }}</h5>
                <p>
                    <span>Stok Barang Tersedia : {{ $item->stok }}</span>
                    <br>
                    <span>Batas Peminjaman Barang : {{ $item->hari_batas_peminjaman }} Hari</span>
                </p>

                {{-- Logic untuk tombol peminjaman --}}
                @php
                    $peminjamanHariIni = App\Models\Peminjaman::whereDate('created_at', now())
                        ->where('user_id', Auth::user()->id)
                        ->whereIn('status', ['Belum Dikonfirmasi', 'Dikonfirmasi'])
                        ->count();

                    $peminjaman = App\Models\Peminjaman::where('barang_id', $item->id)
                        ->where('user_id', Auth::user()->id)
                        ->exists();

                    $dataPeminjaman = App\Models\Peminjaman::where('barang_id', $item->id)
                        ->where('user_id', Auth::user()->id)
                        ->get();

                    $peminjamanBarangHariIni = App\Models\Peminjaman::where('barang_id', $item->id)
                        ->whereDate('created_at', now())
                        ->whereIn('status', ['Belum Dikonfirmasi', 'Dikonfirmasi'])
                        ->count();

                    $setButtonLebihDariSatu = false;
                @endphp

                {{-- Tampilkan tombol sesuai dengan kondisi --}}
                @if (!$peminjaman)
                    @if ($peminjamanHariIni >= 2)
                        <button type="button" class="btn btn-outline-primary mt-auto" data-bs-toggle="modal"
                            data-bs-target="#modalPinjamBarangPerUser">Pinjam Barang</button>
                    @elseif ($peminjamanBarangHariIni >= 4)
                        <button type="button" class="btn btn-outline-primary mt-auto" data-bs-toggle="modal"
                            data-bs-target="#modalPinjamBarangAllUser">Pinjam Barang</button>
                    @else
                        <a href="/form-peminjaman-barang/{{ $item->id }}"
                            class="btn btn-outline-primary mt-auto">Pinjam Barang</a>
                    @endif
                @else
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
                        @endif
                    @endforeach

                    {{-- Tambahkan tombol "Pinjam Barang" jika tidak ada tombol yang ditampilkan --}}
                    @if (!$setButtonLebihDariSatu)
                        @if ($peminjamanHariIni >= 2)
                            <button type="button" class="btn btn-outline-primary mt-auto" data-bs-toggle="modal"
                                data-bs-target="#modalPinjamBarangPerUser">Pinjam Barang</button>
                        @elseif ($peminjamanBarangHariIni >= 4)
                            <button type="button" class="btn btn-outline-primary mt-auto" data-bs-toggle="modal"
                                data-bs-target="#modalPinjamBarangAllUser">Pinjam Barang</button>
                        @else
                            <a href="/form-peminjaman-barang/{{ $item->id }}"
                                class="btn btn-outline-primary mt-auto">Pinjam Barang</a>
                        @endif
                    @endif
                @endif
            </div>
        </div>
    </div>
@endforeach

{{-- Paginasi --}}
@if ($data->hasPages())
    <div class="d-flex justify-content-center pagination-links pt-6">
        {{ $data->appends(['search' => request('search')])->links() }}
    </div>
@endif

{{-- Modal untuk batas peminjaman 2 barang per user per hari --}}
<div class="modal fade" id="modalPinjamBarangPerUser" aria-hidden="true" aria-labelledby="modalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="modalToggleLabel2">Penolakan Peminjaman Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-dark fw-semibold">Maaf, peminjaman barang anda ditolak. Setiap peminjam dibatasi untuk meminjam maksimal 2 barang dalam 1 hari. Terima kasih atas pengertian Anda.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk batas peminjaman barang yang sama oleh 4 user per hari --}}
<div class="modal fade" id="modalPinjamBarangAllUser" aria-hidden="true" aria-labelledby="modalToggleLabel3" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="modalToggleLabel3">Penolakan Peminjaman Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-dark fw-semibold">Maaf, peminjaman barang anda ditolak. Setiap barang hanya dapat dipinjam oleh maksimal 4 user dalam satu hari. Terima kasih atas pengertian Anda.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>
