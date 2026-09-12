<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [

        'appointment_token',

        'name',
        'email',
        'phone',
        'gender',
        'date_of_birth',
        'address',

        'doctor_id',
        'appointment_at',

        'appointment_type',
        'service',
        'body_part',
        'symptoms',
        'medical_history',
        'operation_details',
        'urgency',

        'preferred_doctor',

        'status',

        'admin_notes',
        'patient_message',
    ];

    protected $casts = [

        'date_of_birth' => 'date',

        'appointment_at' => 'datetime',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function preferredDoctor()
    {
        return $this->belongsTo(
            Doctor::class,
            'preferred_doctor'
        );
    }
}