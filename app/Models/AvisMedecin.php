<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvisMedecin extends Model
{
    protected $table = 'avis_medecin';

    protected $fillable = [
        'id_medecin',   // doctor ID
        'user_id',      // patient or user who rated
        'avis',         // review text
        'star',         // rating value
    ];

    public $timestamps = false;
    // Relationships (optional based on your app logic)

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'id_medecin');
    }

    public function user()
    {
        return $this->belongsTo(Patient::class);
    }
}
