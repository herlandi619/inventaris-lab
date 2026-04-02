<!DOCTYPE html>
<html>
<head>

<title>Laporan Data Alat</title>

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
Laporan Data Alat
</h2>

<table>

<thead>

<tr>

<th>No</th>
<th>Nama Alat</th>
<th>Kode</th>
<th>Stok</th>
<th>Kondisi</th>
<th>Tanggal</th>

</tr>

</thead>

<tbody>

@foreach($alat as $a)

<tr>

<td>{{ $loop->iteration }}</td>
<td>{{ $a->nama_alat }}</td>
<td>{{ $a->kode_alat }}</td>
<td>{{ $a->stok }}</td>
<td>{{ $a->kondisi }}</td>
<td>{{ $a->created_at->format('d-m-Y') }}</td>

</tr>

@endforeach

</tbody>

</table>

</body>
</html>