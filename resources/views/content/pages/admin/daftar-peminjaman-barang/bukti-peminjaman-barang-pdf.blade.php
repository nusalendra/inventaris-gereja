<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Peminjaman Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 0 auto;
            padding: 20px;
            position: relative;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .header img {
            width: 100px;
            height: auto;
            margin-right: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
            margin-top: 10px;
        }
        .content {
            margin-top: 40px;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
        }
        .content table td {
            padding: 10px;
        }
        .content table td:first-child {
            width: 200px; /* Adjusted width to fit the content */
        }
        .content table td:nth-child(2) {
            width: 20px; /* Adjusted width to fit the colon */
        }
        .signature {
            text-align: right;
            margin-top: 40px;
        }
        .signature p {
            margin-bottom: 60px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="favicon-logo.png" alt="Logo">
            <h1>Bukti Peminjaman Barang</h1>
        </div>
        <div class="content">
            <p style="font-weight: bold;">Telah melakukan peminjaman barang berupa :</p>
            <table>
                <tr>
                    <td>Barang</td>
                    <td>:</td>
                    <td>{{ $data->barang->nama }}</td>
                </tr>
                <tr>
                    <td>Kegiatan</td>
                    <td>:</td>
                    <td>{{ $data->kategori->nama }}</td>
                </tr>
                <tr>
                    <td>Tanggal Pengajuan</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Tanggal Peminjaman</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal_peminjaman)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Tanggal Pengembalian</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal_pengembalian)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Jumlah Barang Dipinjam</td>
                    <td>:</td>
                    <td>{{ $data->jumlah }} barang</td>
                </tr>
                <tr>
                    <td>Lokasi Barang Digunakan</td>
                    <td>:</td>
                    <td>{{ $data->lokasi_barang }}</td>
                </tr>
            </table>
        </div>
        <div class="signature">
            <p style="font-weight: bold;">Peminjam</p>
            <br>
            <p>{{ $user->name }}</p>
        </div>
    </div>
</body>
</html>
