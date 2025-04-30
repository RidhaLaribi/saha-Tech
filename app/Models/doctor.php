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
        'pic',
        'location',
        'price',
        'description',
        'work_days',
        'home_visit',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function rendez()
    {
        return $this->hasMany(rendezvous::class);
    }
}
