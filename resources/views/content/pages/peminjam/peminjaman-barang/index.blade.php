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
                        <a href="javascript:void(0)" class="btn btn-outline-primary mt-auto">Pinjam Barang</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
