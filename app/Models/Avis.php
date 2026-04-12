<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    protected $fillable = [
        'user_id',
        'logement_id',
        'note',
        'commentaire',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function logement()
    {
        return $this->belongsTo(Logement::class);
    }
}
