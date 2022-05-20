<?php

namespace App\Http\Controllers\faculty;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignmentSubmit;
use App\Models\Assignment;
class AssignmentCheck extends Controller
{
    //
    function AssignmentCheck($id)
    {
         $assignment=Assignment::where(['id'=>$id])->first();
         $student_assignment=AssignmentSubmit::where(['assignment_id'=>$id])->get(); 
         return view('faculty/faculty_assignment_check',compact('assignment','student_assignment'));    
    }
    function AssignmentCheckUpdate(Request $request, $id)
    {
        AssignmentSubmit::find($id)->update($request->all());
        
        return \Redirect::route('assignmentCheck', ['assignment_id'=>$request->assignment_id]);
    }
}
