<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchSemesters extends Model
{
    use HasFactory;
    protected $fillable = [
        'batch_id',
        'semester_id',
        'department_id'
    ];
}
