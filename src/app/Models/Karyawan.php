<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawans'; // Sesuaikan dengan nama tabel di database jika berbeda
    protected $fillable = [
        'nama',
        'email',
        'alamat',
        'telepon',
        'jabatan',
    ];

    /**
     * Relasi ke tabel gajis
     */
    public function gajis(): HasMany
    {
        return $this->hasMany(Gaji::class);
    }
}
