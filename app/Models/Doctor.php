<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [

        'name',
        'specialization',
        'phone',
        'email',

        'qualification',
        'experience',
        'specialist_body_part',
        'bio',

        'available_days',
        'available_from',
        'available_to',

        'consultation_fee',
        'is_active',
    ];

    protected $casts = [

        'available_from' => 'datetime:H:i',
        'available_to' => 'datetime:H:i',

        'is_active' => 'boolean',
    ];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}