<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class band_lid extends Model
{
    use HasFactory;

    protected $fillable = [
        'band_id', 'user_id'
    ];
}
