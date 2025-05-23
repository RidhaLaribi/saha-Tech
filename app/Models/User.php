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

    use HasFactory;


    protected $fillable = [
        'pic',
        'name',
        'email',
        'email_verified_at',
        'tel',
        'role',
        'password',
    ];


    protected $hidden = [
        'password'
    ];


    public function getAuthPassword()
    {
        return $this->password;
    }

    public function patient()
    {
        return $this->hasMany(patient::class, "user_id", "id");
    }
    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'user_id');
    }

    public function medfiles()
    {
        return $this->hasMany(MedecalFile::class, "user_id");

    }
    public function group()
    {
        return $this->hasMany(Patient::class, "user_id");

    }

}
