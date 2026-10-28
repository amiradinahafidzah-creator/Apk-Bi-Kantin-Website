<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\User;

class SiswaController extends Controller
{
    // Beranda / Katalog Menu
    public function dashboard(Request $request)
    {
        $kategori = $request->get('kategori', 'Semua');
        if ($kategori != 'Semua') {
            $menu = Menu::where('kategori', $kategori)->get();
        } else {
            $menu = Menu::all();
        }

        return view('siswa.dashboard', compact('menu', 'kategori'));
    }

    // Detail Menu
    public function detailMenu($id)
    {
        $menu = Menu::findOrFail($id);
        return view('siswa.detail', compact('menu'));
    }

    // Keranjang Belanja (Menggunakan Session)
    public function keranjang()
    {
        $cart = session()->get('cart', []);
        $totalHarga = 0;
        foreach ($cart as $item) {
            $totalHarga += $item['harga'] * $item['jumlah'];
        }
        return view('siswa.keranjang', compact('cart', 'totalHarga'));
    }

    // Tambah Ke Keranjang
    public function tambahKeranjang(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $cart = session()->get('cart', []);
        $jumlah = $request->get('jumlah', 1);

        if (isset($cart[$id])) {
            $cart[$id]['jumlah'] += $jumlah;
        } else {
            $cart[$id] = [
                'id' => $menu->id,
                'nama_menu' => $menu->nama_menu,
                'harga' => $menu->harga,
                'foto' => $menu->foto,
                'kategori' => $menu->kategori,
                'jumlah' => $jumlah
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('siswa.keranjang')->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }

    // Hapus/Update Item Keranjang
    public function updateKeranjang(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if ($request->aksi == 'hapus') {
            unset($cart[$id]);
        } elseif ($request->aksi == 'tambah') {
            $cart[$id]['jumlah'] += 1;
        } elseif ($request->aksi == 'kurang' && $cart[$id]['jumlah'] > 1) {
            $cart[$id]['jumlah'] -= 1;
        }
        session()->put('cart', $cart);
        return redirect()->back();
    }

    // Proses Checkout
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('siswa.dashboard')->with('error', 'Keranjang belanja kosong!');
        }

        $userId = session('user_id');
        $noTransaksi = 'TRX-' . rand(10000000, 99999999);
        $totalBayar = 0;
        $items = [];

        foreach ($cart as $item) {
            $subtotal = $item['harga'] * $item['jumlah'];
            $totalBayar += $subtotal;
            
            // Simpan ke database
            Pesanan::create([
                'user_id' => $userId,
                'menu_id' => $item['id'],
                'jumlah' => $item['jumlah'],
                'total_harga' => $subtotal,
                'status' => 'di proses'
            ]);
            $items[] = $item['nama_menu'];
        }

        // Hapus Keranjang
        session()->forget('cart');

        $detail = [
            'no_transaksi' => $noTransaksi,
            'nama' => session('username'),
            'total_pembayaran' => $totalBayar,
            'status' => 'di proses',
            'waktu' => date('d F Y')
        ];

        return view('siswa.sukses', compact('detail'));
    }

    // Halaman Transaksi Saya
    public function transaksi()
    {
        $userId = session('user_id');
        $riwayat = Pesanan::with('menu')->where('user_id', $userId)->orderBy('id', 'desc')->get();
        return view('siswa.transaksi', compact('riwayat'));
    }

    // Halaman Profil
    public function profil()
    {
        $user = User::find(session('user_id'));
        return view('siswa.profil', compact('user'));
    }
}