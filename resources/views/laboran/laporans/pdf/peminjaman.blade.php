<!DOCTYPE html>
<html>
<head>
<title>Laporan Peminjaman</title>
<style>
body {
    font-family: sans-serif;
    margin: 30px;
}



.kop-table {
    border: none !important;
}
.kop-table td {
    border: none !important;
    border-bottom: 3px double black !important;
}

.kop {
    display: flex;
    align-items: center;
    gap: 16px;
    border-bottom: 3px double black;
    padding-bottom: 12px;
    margin-bottom: 20px;
}
.kop img {
    width: 80px;
    height: 80px;
    object-fit: contain;
}
.kop-text {
    text-align: center;
    flex: 1;
}
.kop-text .nama-kampus {
    font-size: 18px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.kop-text .prodi {
    font-size: 14px;
    font-weight: bold;
}
.kop-text .alamat {
    font-size: 11px;
    color: #333;
    margin-top: 4px;
}

/* ─── JUDUL LAPORAN ─── */
.judul {
    text-align: center;
    margin-bottom: 16px;
}
.judul h2 {
    font-size: 15px;
    text-transform: uppercase;
    text-decoration: underline;
    margin: 0;
}
.judul p {
    font-size: 12px;
    margin: 4px 0 0;
    color: #555;
}

/* ─── TABEL ─── */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    font-size: 12px;
}
table, th, td {
    border: 1px solid black;
}
th, td {
    padding: 6px 8px;
    text-align: left;
}
th {
    background-color: #f0f0f0;
    text-align: center;
}
td:first-child {
    text-align: center;
}

/* ─── FOOTER TANDA TANGAN ─── */
.ttd {
    margin-top: 40px;
    display: flex;
    justify-content: flex-end;
}
.ttd-box {
    text-align: center;
    font-size: 12px;
}
.ttd-box .ttd-space {
    height: 60px;
}
.ttd-box .ttd-nama {
    font-weight: bold;
    text-decoration: underline;
}
</style>
</head>
<body>

{{-- KOP SURAT --}}
@php
    $logoPath = public_path('images/logo_stikes.png');
    $logoSrc = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));

    $ImagePath = public_path('images/image.png'); // sesuaikan nama filenya
    $ImageSrc = 'data:image/png;base64,' . base64_encode(file_get_contents($ImagePath));
@endphp

<!-- Banner atas full width -->
<div style="margin-bottom: 0;">
    <img src="{{ $ImageSrc }}" alt="Banner" style="width:100%; display:block; margin:0; padding:0;">
</div>

{{-- KOP SURAT --}}
<table class="kop-table" style="width:100%; border-collapse:collapse; border-bottom:3px double black; margin-top:10px; padding-bottom:12px;">
    <tr>
        <td style="width:85px; vertical-align:middle; text-align:center; padding:8px 0;">
            <img src="{{ $logoSrc }}" alt="Logo STIKes"
                 style="width:75px; height:75px; object-fit:contain;">
        </td>
        <td style="vertical-align:middle; text-align:center; padding:8px 0;">
            <div style="font-size:18px; font-weight:bold; text-transform:uppercase; letter-spacing:1px;">
                STIKes Widya Dharma Husada
            </div>
            <div style="font-size:14px; font-weight:bold; margin-top:3px;">
                Program Studi D3 Farmasi / S1 Farmasi Klinik dan Komunitas
            </div>
            <div style="font-size:11px; color:#333; margin-top:4px; line-height:1.6;">
                Jl. Surya Kencana No.1, Pamulang, Tangerang Selatan, Banten 15417<br>
                Telp. (021) 7490986 | www.stikeswidyadharmahusada.ac.id
            </div>
        </td>
        <td style="width:85px;"></td>
    </tr>
</table>

{{-- JUDUL LAPORAN --}}
<div class="judul">
    <h2>Laporan Data Alat Laboratorium Farmasi</h2>
    <p>Tanggal Cetak: {{ now()->format('d F Y') }}</p>
</div>

{{-- TABEL --}}
<table>

<thead>

<tr>

<th>No</th>
<th>Mahasiswa</th>
<th>Alat</th>
<th>Tanggal Pinjam</th>
<th>Tanggal Kembali</th>
<th>Status</th>

</tr>

</thead>

@foreach($peminjaman as $p)

<tr>

<td>{{ $loop->iteration }}</td>
<td>{{ $p->mahasiswa->name }}</td>
<td>{{ $p->alat->nama_alat }}</td>
<td>{{ $p->tanggal_pinjam }}</td>
<td>{{ $p->tanggal_kembali }}</td>
<td>{{ $p->status }}</td>

</tr>

@endforeach

</tbody>

</table>

{{-- TANDA TANGAN --}}
<div class="ttd">
    <div class="ttd-box">
        <p>Pamulang, {{ now()->format('d F Y') }}</p>
        <p>PJ Laboratorium Farmasi</p>
        <div class="ttd-space"></div>
        <div class="ttd-nama">Apt. Neneng Sri Purwaningsih, S.Farm., MM., M.Farm</div>
        <div>NIDN. 0323098204</div>
    </div>
</div>

</body>
</html>