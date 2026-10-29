<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
