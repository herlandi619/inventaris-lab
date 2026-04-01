<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    /** @use HasFactory<\Database\Factories\PengembalianFactory> */
    use HasFactory;

    // protected $fillable = [
    //     'peminjaman_id',
    //     'tanggal_dikembalikan',
    //     'kondisi_setelah',
    //     'catatan'
    // ];

    protected $guarded = [];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}
