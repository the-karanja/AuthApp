<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fingerprint extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'fingerprint_data',
    ];

    // Define relationship with the User model if fingerprints are associated with users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
