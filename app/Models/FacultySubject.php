<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultySubject extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id',
        'faculty_id',
        'batch_id',
        'department_id',
        'semester_id',
        'status'
    ];
}
