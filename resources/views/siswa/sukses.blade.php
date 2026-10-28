@extends('layouts.app')

@section('styles')
<style>
    .success-card { max-width: 500px; margin: 40px auto; text-align: center; }
    .success-title { font-size: 28px; font-weight: bold; color: #8B1818; margin-bottom: 8px; }
    .success-sub { color: #A0A0A0; font-size: 14px; margin-bottom: 30px; }
    
    .receipt-table { width: 100%; border: 1px solid #E0E0E0; border-radius: 8px; border-collapse: collapse; background: white; margin-bottom: 25px; overflow: hidden; }
    .receipt-table td { padding: 14px 20px; border-bottom: 1px solid #E0E0E0; font-size: 13px; }
    .receipt-table tr:last-child td { border-bottom: none; }
    .receipt-table td:first-child { color: #A0A0A0; text-align: left; }
    .receipt-table td:last-child { font-weight: bold; text-align: right; color: #333; }
    
    .btn-status { background: #8B1818; color: white; border: none; padding: 12px 30px; border-radius: 8px; font-weight: bold; font-size: 14px; cursor: pointer; width: 100%; text-decoration: none; display: block; box-sizing: border-box; }
    .btn-home { display: inline-block; margin-top: 15px; color: #8B1818; font-weight: bold; text-decoration: none; font-size: 13px; }
</style>
@endsection

@section('content')
<div class="success-card">
    <div class="success-title">Pembayaran Berhasil</div>
    <div class="success-sub">Terimakasih! Pesanan kamu sudah berhasil di bayar</div>

    <table class="receipt-table">
        <tr>
            <td>No Transaksi</td>
            <td>{{ $detail['no_transaksi'] }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>{{ $detail['nama'] }}</td>
        </tr>
        <tr>
            <td>Total Pembayaran</td>
            <td>Rp{{ number_format($detail['total_pembayaran'], 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Status Pesanan</td>
            <td>{{ $detail['status'] }}</td>
        </tr>
        <tr>
            <td>Waktu Pesanan</td>
            <td>{{ $detail['waktu'] }}</td>
        </tr>
    </table>

    <a href="{{ route('siswa.transaksi') }}" class="btn-status">Lihat Status Pesanan</a>
    <a href="{{ route('siswa.dashboard') }}" class="btn-home">Kembali ke beranda</a>
</div>
@endsection