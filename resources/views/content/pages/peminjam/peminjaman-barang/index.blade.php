@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('content')
    <div class="row mb-1">
        <div class="col-md-12 mb-3">
            <form action="{{ url('/peminjaman-barang') }}" method="GET" id="searchForm">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" id="searchInput" placeholder="Cari Barang..."
                        value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>
        </div>

        <div class="row" id="tableBody">
            @include('content.pages.peminjam.peminjaman-barang.paginate', ['data' => $data])
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let searchTerm = '{{ request('search') }}';
            const tableBody = document.getElementById('tableBody');
            const searchInput = document.getElementById('searchInput');

            const loadData = async (searchTerm, page) => {
                try {
                    const response = await fetch(`/peminjaman-barang?search=${searchTerm}&page=${page}`);
                    const html = await response.text();
                    const tempContainer = document.createElement('div');
                    tempContainer.innerHTML = html;
                    const newData = tempContainer.querySelector('#tableBody');

                    if (newData) {
                        tableBody.innerHTML = newData.innerHTML;
                    } else {
                        tableBody.innerHTML = tempContainer.innerHTML;
                    }
                } catch (error) {
                    console.error('Error fetching data:', error);
                }
            };

            searchInput.addEventListener('input', () => {
                searchTerm = searchInput.value; // Simpan term pencarian saat ini
                loadData(searchTerm, 1); // Ganti page ke 1 saat pencarian berubah
            });

            document.addEventListener('click', function(event) {
                if (event.target.matches('.pagination-links a')) {
                    event.preventDefault();
                    const hrefAttribute = event.target.getAttribute('href');

                    // Periksa apakah elemen yang diklik merupakan tautan (link)
                    if (hrefAttribute) {
                        const pageMatch = hrefAttribute.match(
                        /page=(\d+)/); // Match halaman dari tautan paginate
                        if (pageMatch) {
                            const nextPage = pageMatch[1];
                            loadData(searchTerm, nextPage); // Gunakan searchTerm yang disimpan
                        }
                    }
                }
            });
        });
    </script>
@endsection
