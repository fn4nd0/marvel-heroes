<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarvelHero extends Model
{
    use HasFactory;

    protected $table = 'marvel_heroes';

    protected $fillable = [
        'name',
        'marvel_id',
        'description',
        'image_url',
        'votes',
    ];
}
