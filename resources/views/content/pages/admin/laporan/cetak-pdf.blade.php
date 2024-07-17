<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Peminjaman Barang</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        header {
            text-align: center;
            margin-bottom: 10px;
        }

        h1 {
            font-size: 2rem;
            color: #343a40;
            font-weight: bold;
            border-bottom: 2px solid #343a40;
            display: inline-block;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <header>
        <h2>Laporan Peminjaman Barang Selesai</h2>
    </header>
    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Peminjam</th>
                        <th>Barang</th>
                        <th>Kegiatan</th>
                        <th>Tgl Peminjaman - Pengembalian</th>
                        <th>Jumlah</th>
                        <th>Lokasi Barang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->barang->nama }}</td>
                            <td>{{ $item->kategori->nama }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d-m-Y') }} s/d
                                {{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->format('d-m-Y') }}
                                ({{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->diffInDays($item->tanggal_pengembalian) }}
                                hari)
                            </td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->lokasi_barang }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
