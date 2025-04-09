<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Consultation extends Model
{
    protected $table = "consultation";

    protected $fillable = [
        'rendez_vous_id',
        'doctor_id',
        'patient_id',
        'note'
    ];

    // ✅ Each consultation belongs to *one* rendezvous
    public function rend()
    {
        return $this->belongsTo(Rendezvous::class, 'rendez_vous_id');
    }

    // ✅ Each consultation belongs to *one* doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    // (Optional) If you have a Patient model and `patient_id` column exists:
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
