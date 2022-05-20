<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model
{
    use HasFactory,HasApiTokens;

    protected $fillable = [
        'enrollment_number',
        'full_name',
        'email',
        'password',
        'mobile_number',
        'batch_id',
        'profile'
    ];
}
