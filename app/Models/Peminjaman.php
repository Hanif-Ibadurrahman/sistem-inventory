<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_peminjaman', 'email', 'label_loker', 'nama_inventory', 'jumlah', 'pemilik', 'deskripsi', 'lokasi', 'alasan_peminjaman', 'dipinjam', 'dikembalikan', 'status_peminjaman', 'token', 'token_return', 'kondisi_inventory', 'notif_waktu_pengembalian', 'notif_belum_mengembalikan',
    ]; 
}
