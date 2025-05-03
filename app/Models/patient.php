<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';

    protected $fillable = [
        'user_id',
        'pic',
        'name',
        'age',
        'sexe',
        'rel'
    ];

    // Define the relationship: A patient belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function doctor()
    {
        return $this->hasMany(doctor::class, "user_id");
    }
    public function medfiles()
    {
        return $this->hasMany(MedecalFile::class, "user_id");

    }
    public function rendezvous()
    {
        return $this->hasMany(rendezvous::class, "patient_id")->orderBy('rendezvous', 'desc');
    }
    public function notes()
    {
        return $this->hasMany(consultation::class, "patient_id");
    }
}
