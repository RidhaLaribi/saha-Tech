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
        'age',
        'sexe',
        'telephone',
    ];

    // Define the relationship: A patient belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
