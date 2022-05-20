<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BatchSemesters;
use App\Models\Batch;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\FacultySubjectMaterials;
use DB;
class SubjectCourseSemester extends Controller
{
    //
    public function getSemester($id)
    {
        //
        //$batch_sem=FacultySubjectMaterials::where('batch_id',$id)->pluck('semester_id')->toArray();
        $batch_sem=BatchSemesters::where('batch_id',$id)->pluck('semester_id')->toArray();
            $sem=Semester::whereIn('semester',$batch_sem)->get();
            if(count($sem)>0)
            {
                return response()->json($sem, 200,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
            } 
    }
    public function getSubject($batch_id,$semester_id)
    {
         $batch=Batch::where('id',$batch_id)->get();
         $department=$batch[0]->department_id;
        $subject=Subject::where(["semester_id"=>$semester_id,"department_id"=>$department])->get();
         if(count($subject)>0)
         {
            return response()->json($subject, 200,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
         }
         else
         {
            return response()->json($subject, 200,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
         }
    }
    public function getMaterial($batch_id,$subject_id)
    {
        $check=array("faculty_subject_materials.batch_id"=>$batch_id,"faculty_subject_materials.subject_id"=>$subject_id);
       return $subject=DB::table('faculty_subject_materials')
        ->leftJoin('faculties', 'faculty_subject_materials.faculty_id', '=', 'faculties.id')
        ->where($check)
        ->get();
    }
    public function getProgram($batch_id,$subject_id)
    {
        $check=array("faculty_programs.batch_id"=>$batch_id,"faculty_programs.subject_id"=>$subject_id);
       return $subject=DB::table('faculty_programs')
        ->Join('faculties', 'faculty_programs.faculty_id', '=', 'faculties.id')
        ->Join('subjects','faculty_programs.subject_id','=','subjects.id')
        ->where($check)
        ->get();
    }
}
