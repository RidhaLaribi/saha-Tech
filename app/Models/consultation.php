<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class consultation extends Model
{
    protected $table = "consultation";
    protected $fillable = [
        'rendez_vous_id',
        'doctor_id',
        'note'
    ];
}
