<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Logement extends Model
{
    protected $fillable = [
        'user_id',
        'titre',
        'description',
        'prix',
        'type',
        'ville',
        'adresse',
        'latitude',
        'longitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
