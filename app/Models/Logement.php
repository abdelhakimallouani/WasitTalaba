<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function images()
    {
        return $this->hasMany(LogementImage::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function favoris()
    {
        return $this->hasMany(Favori::class);
    }
        public function getIsFavoriteAttribute()
    {
        return auth()->check() && $this->favoris()->where('user_id', auth()->id())->exists();
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }
}
