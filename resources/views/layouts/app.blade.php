<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiKantin - Aplikasi Kantin Online</title>
    <style>
        * { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; }
        body { background-color: #FAFAFA; color: #333; display: flex; flex-direction: column; min-height: 100vh; }
        
        /* Navbar Responsif */
        header { background-color: #8B1818; color: white; padding: 12px 5%; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .brand { display: flex; align-items: center; gap: 10px; font-size: 20px; font-weight: bold; text-decoration: none; color: white; }
        .brand img { width: 35px; height: 35px; border-radius: 50%; background: white; padding: 2px; }
        nav { display: flex; gap: 20px; align-items: center; }
        nav a { color: white; text-decoration: none; font-size: 15px; font-weight: 500; opacity: 0.9; transition: 0.2s; }
        nav a:hover, nav a.active { opacity: 1; font-weight: bold; border-bottom: 2px solid white; padding-bottom: 2px; }
        
        /* Main Container */
        main { flex: 1; padding: 20px 5%; max-width: 1200px; margin: 0 auto; width: 100%; }

        /* Footer */
        footer { background-color: #F3EAE8; color: #A08C8A; padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; font-size: 13px; margin-top: auto; }
        
        /* Media Query HP */
        @media (max-width: 600px) {
            header { flex-direction: column; gap: 15px; text-align: center; padding: 15px; }
            nav { width: 100%; justify-content: space-around; font-size: 14px; }
            footer { flex-direction: column; gap: 10px; text-align: center; }
        }
    </style>
    @yield('styles')
</head>
<body>

<header>
    <a href="{{ route('siswa.dashboard') }}" class="brand">
        <img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png" alt="Logo">
        <span>BiKantin</span>
    </a>
    <nav>
        <a href="{{ route('siswa.dashboard') }}" class="{{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">Beranda</a>
        <a href="{{ route('siswa.keranjang') }}" class="{{ request()->routeIs('siswa.keranjang') ? 'active' : '' }}">Keranjang</a>
        <a href="{{ route('siswa.transaksi') }}" class="{{ request()->routeIs('siswa.transaksi') ? 'active' : '' }}">Transaksi</a>
        <a href="{{ route('siswa.profil') }}" class="{{ request()->routeIs('siswa.profil') ? 'active' : '' }}">Profil</a>
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer>
    <div>Amira Dina Hafidzah</div>
    <div>&copy; Bi-Kantin2026</div>
</footer>

</body>
</html>