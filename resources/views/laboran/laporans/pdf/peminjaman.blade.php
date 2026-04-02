<!DOCTYPE html>
<html>
<head>

<title>Laporan Peminjaman</title>

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
Laporan Peminjaman
</h2>

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

<tbody>

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

</body>
</html>