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

    // protected $fillable = [
    //     'mahasiswa_id',
    //     'alat_id',
    //     'tanggal_pinjam',
    //     'tanggal_kembali',
    //     'status'
    // ];

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
