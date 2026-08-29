<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'gender',
        'date_of_birth',
        'address',
        'doctor_id'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}