@extends('layouts.app')

@section('styles')
<style>
    .back-btn { display: inline-block; color: #8B1818; text-decoration: none; font-weight: bold; margin-bottom: 20px; font-size: 13px; }
    .detail-container { display: flex; gap: 40px; align-items: center; flex-wrap: wrap; margin-top: 10px; }
    .detail-img { flex: 1; min-width: 300px; max-width: 500px; border-radius: 12px; overflow: hidden; border: 1px solid #E0E0E0; }
    .detail-img img { width: 100%; height: auto; display: block; }
    .detail-info { flex: 1; min-width: 280px; }
    .menu-title { font-size: 32px; font-weight: bold; color: #000; margin-bottom: 5px; }
    .menu-cat { font-size: 18px; color: #A0A0A0; margin-bottom: 15px; }
    .menu-price { font-size: 24px; font-weight: bold; color: #8B1818; margin-bottom: 15px; }
    .menu-desc { color: #A0A0A0; font-size: 13px; line-height: 1.6; margin-bottom: 30px; }
    .btn-add-cart { background: #8B1818; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-weight: bold; font-size: 13px; cursor: pointer; float: right; }
</style>
@endsection

@section('content')
<a href="{{ route('siswa.dashboard') }}" class="back-btn">&larr; Kembali Belanja</a>

<div class="detail-container">
    <div class="detail-img">
        <img src="{{ $menu->foto ? asset('images/'.$menu->foto) : 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&w=500&q=80' }}" alt="{{ $menu->nama_menu }}">
    </div>

    <div class="detail-info">
        <div class="menu-title">{{ $menu->nama_menu }}</div>
        <div class="menu-cat">{{ $menu->kategori }}</div>
        <div class="menu-price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
        <div class="menu-desc">
            {{ $menu->deskripsi ?? 'Ayam oreng Krispi yang disajikan dengan sambal pedas khas, lengkap denan nasi, lalapan, dan irisan tmun. cocok serta tomat' }}
        </div>

        <form action="{{ route('siswa.keranjang.tambah', $menu->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn-add-cart">Tambah Ke keranjang</button>
        </form>
    </div>
</div>
@endsection