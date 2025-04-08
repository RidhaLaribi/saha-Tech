<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rendezvous extends Model
{
    protected $table = 'rendez_vous';

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id');
    }
}
