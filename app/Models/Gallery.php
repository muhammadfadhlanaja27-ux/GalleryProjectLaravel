<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    // Ini adalah baris sakti yang abang butuhin:
    protected $fillable = [
        'title',
        'slug',
        'category',
        'image',
        'description'
    ];
}