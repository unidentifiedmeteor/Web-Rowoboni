<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>
<body>

<header>
    <div class="logo">
        Desa Wisata Rowoboni
    </div>

    <nav>
        <a href="#">Pengaturan Admin</a>
        <a href="#">Kelola Pesanan</a>
        <a href="/admin/wisata">Kelola Wisata</a>
        <a href="/admin/galeri">Kelola Galeri</a>
        <a href="/admin/logout">Keluar</a>
    </nav>
</header>

<div class="container">

    <h2>Selamat Datang, Admin 👋</h2>

    <div class="subtitle">
        Periksa bukti transfer sebelum memberikan persetujuan.
    </div>

    <div class="cards">

        <div class="card warning">
            <h3>Belum Dicek</h3>
            <span>1</span>
        </div>

        <div class="card success">
            <h3>Terverifikasi</h3>
            <span>0</span>
        </div>

        <div class="card info">
            <h3>Total Pesanan</h3>
            <span>0</span>
        </div>

    </div>

    <div class="table-container">

        <h3>Tabel Pesanan Masuk</h3>

        <table>

            <thead>
            <tr>
                <th>Nama Pemesan</th>
                <th>Tanggal</th>
                <th>Wisata</th>
                <th>Total Bayar</th>
                <th>Bukti Transfer</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            </thead>

            <tbody>

            <tr>
                <td>Hermawan</td>
                <td>09/06/2026</td>
                <td>Embung Rowoboni</td>
                <td>Rp120.000</td>
                <td><a href="#">Lihat</a></td>
                <td>
                    <span class="status pending">
                        Belum Dicek
                    </span>
                </td>
                <td>
                    <button class="btn-approve">
                        Setujui
                    </button>
                </td>
            </tr>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>