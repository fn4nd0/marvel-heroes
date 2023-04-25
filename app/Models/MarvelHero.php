<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarvelHero extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'marvel_heroes';

    // The attributes that are mass assignable.
    protected $fillable = [
        'name',
        'marvel_id',
        'description',
        'image_url',
        'votes',
    ];
}
