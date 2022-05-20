<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacultySubject;
use App\Models\Subject;
use App\Models\FacultyProgram;
class FacultyUploadProgram extends Controller
{
    //
    function getBatchDetails(Request $request)
    {
        $faculty_id=$request->session()->get('faculty_id')['id'];
         $faculty_batch=FacultySubject::all()->where('faculty_id',$faculty_id)->unique('batch_id');
        return view('faculty/faculty_program',compact('faculty_batch'));
    }
    function faculty_program_subject(Request $request)
    {
        $batch_id=$request->batch_id;
        $faculty_id=$request->session()->get('faculty_id')['id'];
        $faculty_semester=FacultySubject::all()->where('batch_id',$batch_id)->where('faculty_id',$faculty_id)->unique('semester_id');
        return view('faculty/faculty_program_semester',compact('faculty_semester'));
    }
    function faculty_program_semester(Request $request)
    {
        $department_id=$request->department_id;
        $semester_id=$request->semester_id;
        $batch_id=$request->batch_id;
        $faculty_id=$request->session()->get('faculty_id')['id'];
        $faculty_subject=FacultySubject::where('faculty_id',$faculty_id)->where('batch_id',$batch_id)->where('department_id',$department_id)->where('semester_id',$semester_id)->get();
        return view("faculty/faculty_program_subject",compact('faculty_subject'));
    }
    function faculty_program(Request $request)
    {
        $department_id=$request->department_id;
        $semester_id=$request->semester_id;
        $batch_id=$request->batch_id;
        $subject_id=$request->subject_id;
        $faculty_id=$request->session()->get('faculty_id')['id'];
        $faculty_subject_detail=['department_id'=>$department_id,'faculty_id'=>$faculty_id,'semester_id'=>$semester_id,'batch_id'=>$batch_id,'subject_id'=>$subject_id];
         $faculty_subject_detail_fetch=FacultySubject::where($faculty_subject_detail)->get();
        $faculty_subject_material_id=$faculty_subject_detail_fetch[0]->id;
        $faculty_program=FacultyProgram::where("faculty_subject_id",$faculty_subject_material_id)->get();
        return view('faculty/faculty_program_upload',compact('faculty_subject_detail_fetch','faculty_program'));
    }
}
