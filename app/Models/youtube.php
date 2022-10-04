<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
    use HasFactory;

   //public $timestamps = false;

    protected $fillable = ['band_id', 'url'];

    // create oneToMany relationship with Band
    public function bands()
    {
        return $this->belongsTo(Band::class);
    }
}
