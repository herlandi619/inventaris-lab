<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = [
        'alat_id',
        'ruangan',
        'tanggal_maintenance',
        'jenis',
        'deskripsi',
        'biaya',
        'teknisi',
        'status'
    ];

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }
}