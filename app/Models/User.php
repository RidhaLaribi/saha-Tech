<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable
{
    use Notifiable;

    


    protected $fillable = [
        'name',
        'email',
        'tel',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
    
     */
    protected $hidden = [
        'password'
    ];


    public function getAuthPassword()
    {
        return $this->password;
    }
    public function rendezvous()
    {
        return $this->hasMany(rendezvous::class, "user_id");
    }

    public function  patient()
    {
        return $this->hasMany(patient::class, "user_id");
    }
    public function  doctor()
    {
        return $this->hasMany(doctor::class, "user_id");
    }
}
