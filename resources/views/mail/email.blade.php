
<h1>{{ $subject }}</h1>
@if ($transaksi->status == 'Pembayaran Dikonfirmasi' )
    <p>Pesanan Anda telah diterima dan sedang diverifikasi oleh admin.</p>
@else
    <p>Laporan Anda telah diperbarui dengan status "{{$transaksi->status}}".</p>    
@endif
@if ($transaksi->status == 'Pesanan Dibuat')
    <p>
        Pesanan Anda telah diproses dan sedang dikerjakan.
    </p>
@endif

<p>Berikut adalah detail pesanan Anda:</p>
<table style="min-width: 100%">
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{ $userName}}</td>
    </tr>
    <tr>
        <td>Nomor Pesanan</td>
        <td>:</td>
        <td>{{ $transaksi->nomor_pesanan }}</td>
    </tr>
    <tr>
        <td>Jumlah Pemesanan</td>
        <td>:</td>
        <td>{{ $transaksi->jml_total }}</td>
    </tr>
    <tr>
        <td>Total Harga</td>
        <td>:</td>
        <td>{{ $transaksi->total_harga }}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{ $transaksi->alamat }}</td>
    </tr>
</table>

<p>Terima kasih.</p>

