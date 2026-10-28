@extends('layouts.app')

@section('styles')
<style>
    .banner { width: 100%; height: 200px; border-radius: 12px; overflow: hidden; margin-bottom: 25px; }
    .banner img { width: 100%; height: 100%; object-fit: cover; }
    
    .categories { display: flex; gap: 12px; margin-bottom: 25px; overflow-x: auto; padding-bottom: 5px; }
    .cat-btn { padding: 8px 24px; border-radius: 20px; border: 1px solid #D1D1D1; background: white; color: #8B1818; font-weight: 500; font-size: 13px; text-decoration: none; white-space: nowrap; }
    .cat-btn.active { background: #8B1818; color: white; border-color: #8B1818; }

    .section-title { font-size: 18px; color: #555; margin-bottom: 20px; font-weight: 600; }

    .grid-menu { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px; }
    .card-menu { background: white; border: 1px solid #E5E5E5; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.02); display: flex; flex-direction: column; justify-content: space-between; }
    .card-menu img { width: 100%; height: 160px; object-fit: cover; }
    .card-body { padding: 15px; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between; }
    .menu-name { font-weight: bold; font-size: 15px; margin-bottom: 4px; color: #222; }
    .menu-cat { font-size: 11px; color: #A0A0A0; margin-bottom: 8px; }
    .menu-price { font-weight: bold; color: #8B1818; font-size: 14px; margin-bottom: 12px; }
    
    .order-form { display: flex; gap: 6px; align-items: center; margin-top: auto; }
    .input-qty { width: 50px; padding: 6px; border: 1px solid #DDD; border-radius: 6px; text-align: center; font-size: 12px; }
    .btn-order { background: #8B1818; color: white; border: none; padding: 7px 12px; border-radius: 6px; font-size: 12px; font-weight: bold; cursor: pointer; flex-grow: 1; }
    .btn-order:hover { background: #6b1212; }

    /* Tabel Riwayat Pesanan */
    .table-container { margin-top: 40px; overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
    th, td { border: 1px solid #eee; padding: 12px; text-align: left; font-size: 14px; }
    th { background: #333; color: white; }
</style>
@endsection

@section('content')
<!-- Banner -->
<div class="banner">
    <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80" alt="Banner Makanan">
</div>

<!-- Kategori Filter -->
<div class="categories">
    <a href="?kategori=Semua" class="cat-btn {{ ($kategori ?? 'Semua') == 'Semua' ? 'active' : '' }}">Semua</a>
    <a href="?kategori=Makanan" class="cat-btn {{ ($kategori ?? '') == 'Makanan' ? 'active' : '' }}">Makanan</a>
    <a href="?kategori=Minuman" class="cat-btn {{ ($kategori ?? '') == 'Minuman' ? 'active' : '' }}">Minuman</a>
    <a href="?kategori=nyemil" class="cat-btn {{ ($kategori ?? '') == 'nyemil' ? 'active' : '' }}">nyemil</a>
    <a href="?kategori=Desert" class="cat-btn {{ ($kategori ?? '') == 'Desert' ? 'active' : '' }}">Desert</a>
</div>

<div class="section-title">Katalog Menu & Pemesanan</div>

<!-- Grid Menu -->
<div class="grid-menu">
    @foreach($menu as $m)
    <div class="card-menu">
        @if($m->foto)
            <img src="{{ asset('images/'.$m->foto) }}" alt="{{ $m->nama_menu }}">
        @else
            <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&w=500&q=80" alt="No Image">
        @endif

        <div class="card-body">
            <div>
                <div class="menu-name">{{ $m->nama_menu }}</div>
                <div class="menu-cat">{{ $m->kategori }}</div>
                <div class="menu-price">Rp {{ number_format($m->harga, 0, ',', '.') }}</div>
            </div>
            
            <!-- Form Pemesanan Langsung -->
            <form action="/siswa/pesan" method="POST" class="order-form">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $m->id }}">
                <input type="number" name="jumlah" class="input-qty" value="1" min="1">
                <button type="submit" class="btn-order">Pesan</button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<!-- Riwayat Pesanan -->
<div class="table-container">
    <div class="section-title" style="margin-bottom: 10px;">Status Pesanan Saya</div>
    <table>
        <thead>
            <tr>
                <th>Menu</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayatPesanan ?? [] as $rp)
            <tr>
                <td>{{ $rp->menu->nama_menu ?? '-' }}</td>
                <td>{{ $rp->jumlah }}</td>
                <td>Rp {{ number_format($rp->total_harga, 0, ',', '.') }}</td>
                <td><b style="color: #8B1818;">{{ $rp->status }}</b></td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; color: #777;">Belum ada riwayat pesanan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection