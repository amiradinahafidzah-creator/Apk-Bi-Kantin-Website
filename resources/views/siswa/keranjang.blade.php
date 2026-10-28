@extends('layouts.app')

@section('styles')
<style>
    .page-title { font-size: 28px; font-weight: bold; margin-bottom: 5px; }
    .page-subtitle { color: #A0A0A0; font-size: 14px; margin-bottom: 30px; }
    
    .cart-grid { display: flex; gap: 30px; flex-wrap: wrap; }
    .cart-items { flex: 2; min-width: 300px; }
    .cart-summary { flex: 1; min-width: 280px; background: white; border: 1px solid #E0E0E0; border-radius: 12px; padding: 25px; height: fit-content; }
    
    .cart-card { background: white; border: 1px solid #E0E0E0; border-radius: 12px; padding: 12px; margin-bottom: 15px; display: flex; align-items: center; gap: 15px; position: relative; }
    .cart-card img { width: 90px; height: 70px; object-fit: cover; border-radius: 8px; }
    .cart-info { flex: 1; }
    .cart-price { font-weight: bold; font-size: 14px; color: #000; margin-bottom: 3px; }
    .cart-name { color: #A0A0A0; font-size: 12px; margin-bottom: 8px; }
    
    .qty-stepper { display: flex; align-items: center; gap: 8px; border: 1px solid #E0E0E0; border-radius: 4px; padding: 2px 8px; width: fit-content; font-size: 12px; }
    .qty-stepper button { background: none; border: none; font-weight: bold; cursor: pointer; color: #555; }
    
    .btn-delete { position: absolute; right: 15px; top: 15px; background: none; border: none; color: #8B1818; cursor: pointer; font-size: 16px; }

    .summary-title { font-size: 20px; font-weight: bold; margin-bottom: 20px; }
    .summary-item { display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 12px; }
    .summary-item .item-name { font-weight: bold; color: #333; }
    .summary-item .item-sub { color: #A0A0A0; font-size: 11px; }
    
    .summary-divider { border-top: 1px solid #E0E0E0; margin: 20px 0; }
    .summary-total { display: flex; justify-content: space-between; font-weight: bold; font-size: 15px; }
    .summary-total .total-price { color: #8B1818; }
    
    .btn-checkout { background: #8B1818; color: white; border: none; width: 100%; padding: 12px; border-radius: 8px; font-weight: bold; font-size: 14px; margin-top: 20px; cursor: pointer; }
    .back-link { display: inline-block; margin-top: 20px; color: #8B1818; font-weight: bold; text-decoration: none; font-size: 13px; }
</style>
@endsection

@section('content')
<div class="page-title">Keranjang Belanja</div>
<div class="page-subtitle">Cek kembali pesanan kamu sebelum melakukan transaksi</div>

<div class="cart-grid">
    <div class="cart-items">
        @forelse($cart as $id => $item)
        <div class="cart-card">
            <img src="{{ $item['foto'] ? asset('images/'.$item['foto']) : 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&w=500&q=80' }}" alt="{{ $item['nama_menu'] }}">
            <div class="cart-info">
                <div class="cart-price">Rp{{ number_format($item['harga'], 0, ',', '.') }}</div>
                <div class="cart-name">{{ $item['nama_menu'] }}</div>
                <div class="qty-stepper">
                    <form action="{{ route('siswa.keranjang.update', $id) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="aksi" value="kurang">
                        <button type="submit">-</button>
                    </form>
                    <span>{{ $item['jumlah'] }}</span>
                    <form action="{{ route('siswa.keranjang.update', $id) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="aksi" value="tambah">
                        <button type="submit">+</button>
                    </form>
                </div>
            </div>
            <form action="{{ route('siswa.keranjang.update', $id) }}" method="POST">
                @csrf
                <input type="hidden" name="aksi" value="hapus">
                <button type="submit" class="btn-delete">&#128465;</button>
            </form>
        </div>
        @empty
        <div style="color: #A0A0A0; padding: 20px 0;">Keranjang belanja kamu masih kosong.</div>
        @endforelse

        <a href="{{ route('siswa.dashboard') }}" class="back-link">&larr; Lanjut Belanja</a>
    </div>

    <div class="cart-summary">
        <div class="summary-title">Ringkasan Pesanan</div>
        
        @foreach($cart as $item)
        <div class="summary-item">
            <div>
                <div class="item-name">{{ $item['nama_menu'] }}</div>
                <div class="item-sub">{{ $item['jumlah'] }} x Rp{{ number_format($item['harga'], 0, ',', '.') }}</div>
            </div>
            <div><b>Rp{{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</b></div>
        </div>
        @endforeach

        <div class="summary-divider"></div>

        <div class="summary-total">
            <span>Total Harga</span>
            <span class="total-price">Rp{{ number_format($totalHarga, 0, ',', '.') }}</span>
        </div>

        @if(!empty($cart))
        <form action="{{ route('siswa.checkout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-checkout">CheckOut</button>
        </form>
        @endif
    </div>
</div>
@endsection