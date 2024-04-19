<?php

namespace TechEd\SimplOtp\Models;

use Illuminate\Database\Eloquent\Model;

class SimplOtp extends Model
{
    protected $table = 'otps';

    protected $fillable = [
        'identifier',
        'token',
        'valid_until',
        'is_valid'
    ];

    protected $casts = [
        'is_valid' => 'boolean'
    ];
}
