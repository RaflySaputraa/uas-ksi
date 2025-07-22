<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    protected $table = 'gajis';

    protected $fillable = [
        'karyawan_id', 'gaji_pokok', 'tunjangan', 'potongan', 'total_gaji'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($gaji) {
            $gaji->total_gaji = ($gaji->gaji_pokok ?? 0) + ($gaji->tunjangan ?? 0) - ($gaji->potongan ?? 0);
        });

        static::updating(function ($gaji) {
            $gaji->total_gaji = ($gaji->gaji_pokok ?? 0) + ($gaji->tunjangan ?? 0) - ($gaji->potongan ?? 0);
        });
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
