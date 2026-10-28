<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pesanan;

class AdminController extends Controller
{
    public function dashboard() {
        $menu = Menu::all();
        $pesanan = Pesanan::with(['user', 'menu'])->get();
        return view('admin.dashboard', compact('menu', 'pesanan'));
    }

    public function storeMenu(Request $request) {
        $request->validate([
            'nama_menu' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $namaFoto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('images'), $namaFoto);
        }

        Menu::create([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'foto' => $namaFoto
        ]);

        return redirect()->back()->with('success', 'Menu dan foto berhasil ditambahkan!');
    }

    public function updateStatus(Request $request, $id) {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();
        return redirect()->back()->with('success', 'Status pesanan diperbarui!');
    }
}
