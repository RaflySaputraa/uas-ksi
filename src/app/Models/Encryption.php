<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encryption extends Model
{
    protected $table = 'encryptions';

    protected $fillable = [
        'original_text',
        'encrypted_text',
    ];
}
