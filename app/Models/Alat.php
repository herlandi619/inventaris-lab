<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    /** @use HasFactory<\Database\Factories\AlatFactory> */
    use HasFactory;

    protected $fillable = [
        'kode_alat',
        'nama_alat',
        'kategori',
        'stok',
        'lokasi',
        'kondisi',
	    'gambar',
        'barcode',
        'deskripsi',
        'tutorial_penggunaan'
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
