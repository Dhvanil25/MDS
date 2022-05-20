<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmit extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id',
        'faculty_id',
        'batch_id',
        'semester_id',
        'faculty_subject_id',
        'assignment_id',
        'student_id',
        'supload_date',
        'pdf',
        'status',
        'note'
    ];
}
