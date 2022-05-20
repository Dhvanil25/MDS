<?php

namespace App\Models;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $fillable = [
        'batch_name',
        'batch_year',
        'department_id'
    ];  
    public function departments()
    {
        return $this->belongsTo(Department::class);
    }
}
