<!DOCTYPE html>
<html>
<head>
    <title>Struk - {{ $transaksi->plat_nomor }}</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; width: 280px; padding: 10px; font-size: 12px; }
        .text-center { text-align: center; }
        .line { border-top: 1px dashed #000; margin: 8px 0; }
        table { width: 100%; }
    </style>
</head>
<body onload="window.print()">
    <div class="text-center">
        <h3 style="margin: 0;">M-PARKIR SYSTEM</h3>
        <p>Struk Parkir</p>
    </div>
    <div class="line"></div>
    <table>
        <tr><td>Plat</td><td>: {{ $transaksi->plat_nomor }}</td></tr>
        <tr><td>Jenis</td><td>: {{ $transaksi->tarif->jenis_kendaraan }}</td></tr>
        <tr><td>Masuk</td><td>: {{ $transaksi->jam_masuk->format('d/m H:i') }}</td></tr>
        {{-- Perbaikan: Proteksi Jam Keluar agar tidak error null --}}
        <tr><td>Keluar</td><td>: {{ $transaksi->jam_keluar ? $transaksi->jam_keluar->format('d/m H:i') : '-' }}</td></tr>
        <tr><td>Durasi</td><td>: {{ $transaksi->durasi ?? '-' }} Jam</td></tr>
    </table>
    <div class="line"></div>
    <div style="text-align: right; font-weight: bold;">
        Total: Rp {{ number_format($transaksi->total_bayar ?? 0) }}
    </div>
    <div class="line"></div>
    <tr>
    <td>Petugas</td>
    <td>: {{ $transaksi->user->username ?? 'Admin' }}</td> 
    {{-- Hasilnya otomatis jadi "idod12" (atau sesuai siapa yang login) --}}
</tr>
</body>
</html>