<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Student;
use App\Models\Subject;
use DB;
use App\Models\AssignmentSubmit;
Use Exception;
class AssignmentManagement extends Controller
{
    //
    public function getAssignment($batch_id,$subject_id)
    {
        $check=array("assignments.batch_id"=>$batch_id,"assignments.subject_id"=>$subject_id);
       return $subject=DB::table('assignments')
        ->join('faculties', 'assignments.faculty_id', '=', 'faculties.id')
        ->where($check)->get([
            'assignments.id',
            'assignments.assignment_title',
            'assignments.assignment_question',
            'assignments.upload_date',
            'assignments.submit_date',
            'faculties.full_name'
        ]);
    }
    public function uploadAssignment(Request $req)
    {
        try
        {
            $assignment_detail=Assignment::where(['id'=>$req->assignment_id])->first(); 
         
            $subject_id=$assignment_detail->subject_id;
            $faculty_id=$assignment_detail->faculty_id;
            $batch_id=$assignment_detail->batch_id;
            $semester_id=$assignment_detail->semester_id;
            $faculty_subject_id=$assignment_detail->faculty_subject_id;
          $student_id=$req->student_id;
           // $student_id="1";
           $supload_date=$req->supload_date;
            //$supload_date="2020-12-12";
            $assignment_id=$req->assignment_id;
            //$assignment_id="3";
            if($req->pdf)
            {
                $pdf=rand().$req->pdf->getClientOriginalName();;
                $req->pdf->move(public_path('upload_assignment'),$pdf);
            }
            AssignmentSubmit::create([
                'faculty_id'=>$faculty_id,
                'faculty_subject_id'=>$faculty_subject_id,
                'batch_id'=>$batch_id,
                'semester_id'=>$semester_id,
                'subject_id'=>$subject_id,
                'assignment_id'=>$assignment_id,
                'supload_date'=>$supload_date,
                'student_id'=>$student_id,
                'pdf'=>$pdf
            ]);
            $response=['message'=>'File Upload Successfully'];
            //return response()->json($response, 400);
            return response()->json($response, 200,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }
        catch(Exception $e)
        {
            $response=['message'=>'File Upload Unsuccessfully'];
            //return response()->json($response, 400);
            return response()->json($response, 400,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }
        

    }
    public function getAssignmentStudent($assignment_id,$student_id)
    {
        $student_assignment_data=AssignmentSubmit::where(['assignment_id'=>$assignment_id])->where(['student_id'=>$student_id])->get();
        if(count($student_assignment_data) > 0)
        {
            return response()->json($student_assignment_data, 200,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }    
        else
        {
            return response()->json($student_assignment_data, 200,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }
    }
    public function assignmentUpdate(Request $req)
    {
         $req->all();
        $assignment_update=AssignmentSubmit::find($req->student_assignment_id);
        unlink("upload_assignment/".$assignment_update->pdf);   
        $supload_date=$req->supload_date;
        $status=0;
        if($req->pdf)
        {
            $pdf=rand().$req->pdf->getClientOriginalName();;
            $req->pdf->move(public_path('upload_assignment'),$pdf);
        }
        $assignment_update->status=$status;
        $assignment_update->supload_date=$supload_date;
        $assignment_update->pdf=$pdf;  
        $assignment_update->save();
    }
}
