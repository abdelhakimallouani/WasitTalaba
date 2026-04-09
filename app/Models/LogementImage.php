<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Logement;

class LogementImage extends Model
{
    protected $fillable = [
        'logement_id',
        'image_path',
    ];

    public function logement()
    {
        return $this->belongsTo(Logement::class);
    }
}
