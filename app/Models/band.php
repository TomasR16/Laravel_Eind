<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'band_name', 'bio', 'photo'
    ];

    public function users()
    {
        // The first argument passed to the hasManyThrough method is the name
        // of the final model we wish to access,
        // while the second argument is the name of the intermediate model.
        return $this->belongsToMany(
            User::class
        );
    }
}
