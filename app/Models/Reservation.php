<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Logement;
use App\Models\User;


class Reservation extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'logement_id',
        'date_debut',
        'date_fin',
        'statut',
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
