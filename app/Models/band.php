<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class band extends Model
{
    use HasFactory;

    protected $fillable = [
        'band_name', 'bio', 'photo'
    ];
}
