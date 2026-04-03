{{-- <!DOCTYPE html>
<html>
<head>

<title>Laporan Pengembalian</title>

<style>

body{
font-family: sans-serif;
}

table{
width:100%;
border-collapse: collapse;
margin-top:20px;
}

table,th,td{
border:1px solid black;
}

th,td{
padding:8px;
text-align:left;
}

</style>

</head>

<body>

<h2 style="text-align:center">
Laporan Pengembalian
</h2>

<table>

<thead>

<tr>

<th>No</th>
<th>Mahasiswa</th>
<th>Alat</th>
<th>Tanggal Dikembalikan</th>
<th>Kondisi</th>
<th>Catatan</th>

</tr>

</thead>

<tbody>

@foreach($pengembalian as $p)

<tr>

<td>{{ $loop->iteration }}</td>
<td>{{ $p->peminjaman->mahasiswa->name }}</td>
<td>{{ $p->peminjaman->alat->nama_alat }}</td>
<td>{{ $p->tanggal_dikembalikan }}</td>
<td>{{ $p->kondisi_setelah }}</td>
<td>{{ $p->catatan }}</td>

</tr>

@endforeach

</tbody>

</table>

</body>
</html> --}}



<!DOCTYPE html>
<html>
<head>

<title>Laporan Pengembalian</title>

<style>
body{
    font-family: sans-serif;
}

table{
    width:100%;
    border-collapse: collapse;
    margin-top:20px;
}

table, th, td{
    border:1px solid black;
}

th, td{
    padding:8px;
    text-align:left;
}
</style>

</head>

<body>

<h2 style="text-align:center">
Laporan Pengembalian
</h2>

<table>
<thead>
<tr>
    <th>No</th>
    <th>Mahasiswa</th>
    <th>Alat</th>
    <th>Tgl Dipinjam</th>
    <th>Tgl Dikembalikan</th>
    <th>Status Peminjaman</th>
    <th>Kondisi</th>
    <th>Catatan</th>
</tr>
</thead>

<tbody>
@foreach($pengembalian as $p)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $p->peminjaman->mahasiswa->name }}</td>
    <td>{{ $p->peminjaman->alat->nama_alat }}</td>
    <td>{{ $p->peminjaman->tanggal_pinjam }}</td>
    <td>{{ $p->tanggal_dikembalikan }}</td>
    <td>{{ ucfirst($p->peminjaman->status) }}</td>
    <td>{{ $p->kondisi_setelah ?? '-' }}</td>
    <td>{{ $p->catatan ?? '-' }}</td>
</tr>
@endforeach
</tbody>
</table>

</body>
</html>