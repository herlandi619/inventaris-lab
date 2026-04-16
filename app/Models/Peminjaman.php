<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    /** @use HasFactory<\Database\Factories\PeminjamanFactory> */
    use HasFactory;

    protected $table = 'peminjamans';

    protected $guarded = [];

    // 🔥 PENTING: kasih tau Laravel ini kolom tanggal
    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
    ];

    


    public function mahasiswa()
    {
        return $this->belongsTo(User::class,'mahasiswa_id');
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }
}
