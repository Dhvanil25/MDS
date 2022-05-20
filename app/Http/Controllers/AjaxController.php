<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    //
    function getBatch(Request $request)
    {
        $batch = DB::table('batches')
            ->where('department_id', $request->department)
            ->get();
        if (count($batch) > 0) {
            return response()->json($batch);
        }
    }
    function getSemster(Request $request)
    {
        $batch= DB::table('batch_semesters')->where('batch_id', $request->batch_id)->pluck('semester_id')->toArray();
         $sem=DB::table('semesters')->whereNotIn('semester',$batch)->get();
        if(count($sem)>0)
        {
            return response()->json($sem);
        }
    }
    function checkSubjectCode(Request $request)
    {
        //return $request->subject_code;
         $subject_code=DB::table('subjects')->where('subject_code', $request->subject_code)->get();
         if(count($subject_code)>0)
         {
             return 1;
         }
         else{
             return 0;
         }
    }
    function getSubject(Request $request){
        $faculty_id=$request->faculty_id;
        $department_id=$request->department_id;
        $facult_subject= DB::table('faculty_subjects')->where('faculty_id',  $faculty_id)->pluck('subject_id')->toArray();
        $subject=DB::table('subjects')->where('department_id',$department_id)->whereNotIn('id',$facult_subject)->get();
        if(count($subject)>0){
            return response()->json($subject);   
        }
    }
    function getBatchSubject(Request $request)
    {
        $batchSubject = DB::table('batch_semesters')
            ->where('department_id', $request->department_id)
            ->where('batch_id',$request->batch_id)
            ->get();
        if (count($batchSubject) > 0) {
            return response()->json($batchSubject);
        }
    }   
    function getBatchDepartmentSubject(Request $request)
    {
          $batchSubject = DB::table('faculty_subjects')
            ->where('department_id', $request->department_id)
            ->where('batch_id',$request->batch_id)
            ->where('faculty_id',$request->faculty_id)
            ->pluck('subject_id')->toArray();
      return  $subject=DB::table('subjects')
        ->where('department_id',$request->department_id)
        ->where('semester_id',$request->semester_id)
        ->whereNotIn('id',$batchSubject)->get();
    }
}
