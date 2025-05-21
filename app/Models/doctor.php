<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctor extends Model
{

    use HasFactory;
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
        'available',
        'home_visit',
        'rating',
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
