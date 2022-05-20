<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultySubjectMaterials extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id',
        'faculty_id',
        'batch_id',
        'semester_id',
        'faculty_subject_id',
        'material_title',
        'material_description',
        'material_video_url',
        'material_pdf'
    ];
}
