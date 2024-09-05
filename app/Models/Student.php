<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'education',
        'address',
        'phone_number',
        'profile_picture',
        'documents',
    ];

    protected $casts = [
        'documents' => 'array',
    ];
}
