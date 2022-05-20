<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'semester_id',
        'department_id',
        'subject_name',
        'subject_code',
        'subject_pratical',
        'subject_theory',
        'subject_syllabus',
        'codemirror_name',
        'api_language'
    ];  
}
