<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Bi-Kantin</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; background: #f8f9fa; color: #333; }
        header { background: #b30000; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .container { padding: 30px; max-width: 1200px; margin: auto; }
        .card { background: white; padding: 20px; margin-bottom: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        h3 { margin-top: 0; color: #b30000; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; background: white; }
        th, td { border: 1px solid #eee; padding: 12px; text-align: left; font-size: 14px; }
        th { background: #b30000; color: white; }
        .form-control { width: 100%; padding: 8px; margin-top: 5px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn { background: #b30000; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .btn:hover { background: #800000; }
        img.menu-img { width: 50px; height: 50px; object-fit: cover; border-radius: 4px; }
        a.logout { color: white; text-decoration: none; background: #800000; padding: 5px 10px; border-radius: 4px; }
    </style>
</head>
<body>

<header>
    <h2>Admin Panel - Bi-Kantin</h2>
    <div>Halo, <b>{{ session('username') }}</b> | <a href="/logout" class="logout">Logout</a></div>
</header>

<div class="container">
    <!-- Form Tambah Menu -->
    <div class="card">
        <h3>Tambah Menu & Foto Produk</h3>
        <form action="/admin/menu/tambah" method="POST" enctype="multipart/form-data">
            @csrf
            <label>Nama Menu</label>
            <input type="text" name="nama_menu" class="form-control" required>

            <label>Harga (Rp)</label>
            <input type="number" name="harga" class="form-control" required>

            <label>Kategori</label>
            <select name="kategori" class="form-control" required>
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
            </select>

            <label>Foto Produk</label>
            <input type="file" name="foto" class="form-control" accept="image/*" required>

            <button type="submit" class="btn">Simpan Menu</button>
        </form>
    </div>

    <!-- Daftar Menu -->
    <div class="card">
        <h3>Daftar Menu Kantin</h3>
        <table>
            <tr>
                <th>Foto</th>
                <th>Nama Menu</th>
                <th>Kategori</th>
                <th>Harga</th>
            </tr>
            @foreach($menu as $m)
            <tr>
                <td>
                    @if($m->foto)
                        <img src="{{ asset('images/' . $m->foto) }}" class="menu-img">
                    @else
                        <span style="font-size:12px; color:#999;">No Image</span>
                    @endif
                </td>
                <td>{{ $m->nama_menu }}</td>
                <td>{{ $m->kategori }}</td>
                <td>Rp {{ number_format($m->harga) }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- Daftar Pesanan -->
    <div class="card">
        <h3>Monitoring Pesanan Masuk</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Pembeli</th>
                <th>Menu</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi Update Status</th>
            </tr>
            @foreach($pesanan as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->user->username ?? '-' }}</td>
                <td>{{ $p->menu->nama_menu ?? '-' }}</td>
                <td>{{ $p->jumlah }}</td>
                <td>Rp {{ number_format($p->total_harga) }}</td>
                <td><b>{{ $p->status }}</b></td>
                <td>
                    <form action="/admin/pesanan/status/{{ $p->id }}" method="POST">
                        @csrf
                        <select name="status" onchange="this.form.submit()" class="form-control" style="margin:0;">
                            <option value="Menunggu Konfirmasi" {{ $p->status == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                            <option value="Sedang Dimasak" {{ $p->status == 'Sedang Dimasak' ? 'selected' : '' }}>Sedang Dimasak</option>
                            <option value="Siap Diambil" {{ $p->status == 'Siap Diambil' ? 'selected' : '' }}>Siap Diambil</option>
                            <option value="Selesai" {{ $p->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

</body>
</html>