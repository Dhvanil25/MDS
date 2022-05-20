<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacultySubject;
use App\Models\Subject;
use App\Models\FacultySubjectMaterials;

class FacultyUploadMaterial extends Controller
{
    //
    function getBatchDetails(Request $request)
    {
        $faculty_id=$request->session()->get('faculty_id')['id'];
         $faculty_batch=FacultySubject::all()->where('faculty_id',$faculty_id)->unique('batch_id');
        return view('faculty/faculty_material',compact('faculty_batch'));
    }
    function faculty_materil_subject(Request $request)
    {
        $batch_id=$request->batch_id;
        $faculty_id=$request->session()->get('faculty_id')['id'];
        $faculty_semester=FacultySubject::all()->where('batch_id',$batch_id)->where('faculty_id',$faculty_id)->unique('semester_id');
        return view('faculty/faculty_materil_semester',compact('faculty_semester'));
    }
    function faculty_materil_semester(Request $request)
    {
        $department_id=$request->department_id;
        $semester_id=$request->semester_id;
        $batch_id=$request->batch_id;
        $faculty_id=$request->session()->get('faculty_id')['id'];
        $faculty_subject=FacultySubject::where('faculty_id',$faculty_id)->where('batch_id',$batch_id)->where('department_id',$department_id)->where('semester_id',$semester_id)->get();
        return view("faculty/faculty_material_subject",compact('faculty_subject'));
    }
    function faculty_material(Request $request)
    {
        $department_id=$request->department_id;
        $semester_id=$request->semester_id;
        $batch_id=$request->batch_id;
        $subject_id=$request->subject_id;
        $faculty_id=$request->session()->get('faculty_id')['id'];
        $faculty_subject_detail=['department_id'=>$department_id,'faculty_id'=>$faculty_id,'semester_id'=>$semester_id,'batch_id'=>$batch_id,'subject_id'=>$subject_id];
        $faculty_subject_detail_fetch=FacultySubject::where($faculty_subject_detail)->get();
        $faculty_subject_material_id=$faculty_subject_detail_fetch[0]->id;
        $faculty_material=FacultySubjectMaterials::where("faculty_subject_id",$faculty_subject_material_id)->get();
        return view('faculty/faculty_material_upload',compact('faculty_subject_detail_fetch','faculty_material'));
    }
}
