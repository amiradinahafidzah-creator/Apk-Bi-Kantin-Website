<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    public $timestamps = false;
    protected $fillable = ['user_id', 'menu_id', 'jumlah', 'total_harga', 'status'];

    // Relasi ke tabel user
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke tabel menu
    public function menu() {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}