<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>E-Ticket</title>

<style>

body{
    font-family: DejaVu Sans, sans-serif;
    background:#f4f4f4;
}

.ticket{

    width:720px;

    margin:auto;

    border:3px solid #2E7D32;

    border-radius:15px;

    background:white;

    overflow:hidden;

}

.header{

    background:#2E7D32;

    color:white;

    padding:20px;

    text-align:center;

}

.header h1{

    margin:0;

    font-size:28px;

}

.header p{

    margin:5px 0 0;

    font-size:14px;

}

.content{

    padding:25px;

}

table{

    width:100%;

    border-collapse:collapse;

}

table td{

    padding:8px;

    font-size:15px;

}

.label{

    width:170px;

    font-weight:bold;

    color:#2E7D32;

}

.qr{

    text-align:center;

    margin-top:25px;

}

.footer{

    margin-top:20px;

    text-align:center;

    font-size:12px;

    color:#777;

}

.ticket-code{

    margin-top:15px;

    display:inline-block;

    background:#2E7D32;

    color:white;

    padding:8px 18px;

    border-radius:30px;

    font-weight:bold;

}

</style>

</head>

<body>

<div class="ticket">

<div class="header">

<h1>DESA WISATA ROWOBONI</h1>

<p>E - TICKET</p>

</div>

<div class="content">

<table>

<tr>

<td class="label">Nama</td>

<td>{{ $booking->nama }}</td>

</tr>

<tr>

<td class="label">Destinasi</td>

<td>{{ $booking->destination->name }}</td>

</tr>

<tr>

<td class="label">Tanggal</td>

<td>{{ $booking->tanggal_kunjungan }}</td>

</tr>

<tr>

<td class="label">Jumlah Tiket</td>

<td>{{ $booking->jumlah_tiket }}</td>

</tr>

<tr>

<td class="label">Total Bayar</td>

<td>Rp {{ number_format($booking->total_harga,0,',','.') }}</td>

</tr>

<tr>

<td class="label">Kode Tiket</td>

<td>

<span class="ticket-code">

{{ $booking->ticket_code }}

</span>

</td>

</tr>

</table>

<div class="footer">

Tunjukkan QR Code ini kepada petugas saat memasuki area wisata.

</div>

</div>

</div>

</body>

</html>