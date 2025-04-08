<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class doctor extends Model
{
    
    protected $table = 'doctors'; 

    protected $fillable = [
        'user_id',
        'doctor_ref',
        'age',
        'gender',
        'type',
        'specialty',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
