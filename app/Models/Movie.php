<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    
    protected $hidden = ['pivot'];

    public function performers()
    {
        return $this->belongsToMany(Performer::class);
    }

    public function userRatings()
    {
        return $this->hasMany(UserRating::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
