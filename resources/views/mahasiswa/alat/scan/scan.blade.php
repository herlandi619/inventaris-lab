@extends('layouts.mahasiswa')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Scan QR Code Alat</h1>
    <div id="reader" style="width:400px"></div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
function onScanSuccess(decodedText) {
    // Jika QR code mengarah ke /laboran/show/..., ubah jadi /show/...
    let newUrl = decodedText.replace('/laboran/show/', '/show/');

    // Redirect ke URL baru
    window.location.href = newUrl;
}

let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", // ID div scanner
    { fps: 10, qrbox: 250 } // opsi scanner
);

html5QrcodeScanner.render(onScanSuccess);
</script>
@endsection