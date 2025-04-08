<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedecalFile extends Model
{
    use HasFactory;
    protected $table = "medecalfiles";

    protected $fillable = [
        'user_id',
        'file_path',
    ];

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class, "id");
    }
}

