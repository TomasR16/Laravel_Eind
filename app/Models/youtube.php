<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'band_id'];

    public function bands()
    {
        return $this->belongsTo(Band::class);
    }
}
