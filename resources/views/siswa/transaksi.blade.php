@extends('layouts.app')

@section('styles')
<style>
    .banner { width: 100%; height: 180px; border-radius: 12px; overflow: hidden; margin-bottom: 25px; }
    .banner img { width: 100%; height: 100%; object-fit: cover; }
    
    .page-title { font-size: 28px; font-weight: bold; margin-bottom: 5px; }
    .page-subtitle { color: #A0A0A0; font-size: 14px; margin-bottom: 25px; }
    
    .trans-card { background: white; border: 1px solid #E0E0E0; border-radius: 12px; padding: 12px 20px; margin-bottom: 15px; display: flex; align-items: center; justify-content: space-between; gap: 15px; }
    .trans-left { display: flex; align-items: center; gap: 15px; }
    .trans-card img { width: 80px; height: 60px; object-fit: cover; border-radius: 8px; }
    .trans-price { font-weight: bold; font-size: 14px; margin-bottom: 3px; }
    .trans-date { color: #A0A0A0; font-size: 11px; margin-bottom: 3px; }
    .trans-name { color: #A0A0A0; font-size: 12px; }
    
    .badge-status { background: #8B1818; color: white; padding: 6px 20px; border-radius: 6px; font-size: 12px; font-weight: bold; text-transform: capitalize; }
</style>
@endsection

@section('content')
<div class="banner">
    <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80" alt="Banner Makanan">
</div>

<div class="page-title">Transaksi Saya</div>
<div class="page-subtitle">Cek status dan riwayat transaksi kamu di sini</div>

@forelse($riwayat as $p)
<div class="trans-card">
    <div class="trans-left">
        <img src="{{ $p->menu && $p->menu->foto ? asset('images/'.$p->menu->foto) : 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&w=500&q=80' }}" alt="Menu">
        <div>
            <div class="trans-price">Rp{{ number_format($p->total_harga, 0, ',', '.') }}</div>
            <div class="trans-date">28 Oktober 2026</div>
            <div class="trans-name">{{ $p->menu->nama_menu ?? '-' }}</div>
        </div>
    </div>
    <div class="badge-status">{{ $p->status }}</div>
</div>
@empty
<div style="color: #A0A0A0; padding: 20px 0;">Belum ada riwayat transaksi.</div>
@endforelse
@endsection