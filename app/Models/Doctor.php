<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'specialization',
        'phone',
        'email'
    ];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}