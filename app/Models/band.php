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

        return $this->belongsToMany(
            User::class
        );
    }

    public static function bandSearch($name)
    {
        return Band::where('band_name', 'LIKE', "%$name%")->get();
    }
}
