<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\FacultySubject;
class ManageUploadAssignment extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function faculty_assignment(Request $request)
    {
        $department_id=$request->department_id;
        $semester_id=$request->semester_id;
        $batch_id=$request->batch_id;
        $subject_id=$request->subject_id;
        $faculty_id=$request->session()->get('faculty_id')['id'];
        $faculty_subject_detail=['department_id'=>$department_id,'faculty_id'=>$faculty_id,'semester_id'=>$semester_id,'batch_id'=>$batch_id,'subject_id'=>$subject_id];
         $faculty_subject_detail_fetch=FacultySubject::where($faculty_subject_detail)->get();
        $faculty_subject_material_id=$faculty_subject_detail_fetch[0]->id;
        $faculty_assignment=Assignment::where("faculty_subject_id",$faculty_subject_material_id)->get();
        return view('faculty/faculty_assignment_upload',compact('faculty_subject_detail_fetch','faculty_assignment'));
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->all();
        if($request->assignment_question)
        {
            $pdf=rand().$request->assignment_question->getClientOriginalName();
            $request->assignment_question->move(public_path('assignment_question'),$pdf);
            $department_id=$request->department_id;
            $faculty_id=$request->faculty_id;
            $batch_id=$request->batch_id;
            $semester_id=$request->semester_id;
            $subject_id=$request->subject_id;
            $faculty_subject_id=$request->faculty_subject_id;
            $assignment_title=$request->assignment_title;
            $upload_date=$request->upload_date;
            $submit_date=$request->submit_date;
            Assignment::create([
                'faculty_id'=>$faculty_id,
                'faculty_subject_id'=>$faculty_subject_id,
                'batch_id'=>$batch_id,
                'semester_id'=>$semester_id,
                'subject_id'=>$subject_id,
                'assignment_title'=>$assignment_title,
                'upload_date'=>$upload_date,
                'submit_date'=>$submit_date,
                'assignment_question'=>$pdf
            ]);
             
    
        }
        $faculty_id=$request->session()->get('faculty_id')['id'];
        $faculty_subject_detail=['department_id'=>$department_id,'faculty_id'=>$faculty_id,'semester_id'=>$semester_id,'batch_id'=>$batch_id,'subject_id'=>$subject_id];
         $faculty_subject_detail_fetch=FacultySubject::where($faculty_subject_detail)->get();
        $faculty_subject_material_id=$faculty_subject_detail_fetch[0]->id;
        $faculty_assignment=Assignment::where("faculty_subject_id",$faculty_subject_material_id)->get();
        return view('faculty/faculty_assignment_upload',compact('faculty_subject_detail_fetch','faculty_assignment'));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $assignment_edit=Assignment::find($id);
        $faculty_subject_detail_fetch=FacultySubject::where('id',$assignment_edit->faculty_subject_id)->get();
        $faculty_subject_assignment_id=$assignment_edit->faculty_subject_id;
        $faculty_assignment=Assignment::where("faculty_subject_id",$faculty_subject_assignment_id)->get(); 
        return view('faculty/faculty_assignment_upload',compact('assignment_edit','faculty_subject_detail_fetch','faculty_assignment'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $assignment_update=Assignment::find($id);
        if($request->assignment_question)
        {
            if($assignment_update->assignment_question)
            {
                unlink("assignment_question/".$assignment_update->assignment_question);   
            }
            $pdf=rand().$request->assignment_question->getClientOriginalName();
            $request->assignment_question->move(public_path('assignment_question'),$pdf);
            $assignment_update->assignment_question=$pdf;
        }
        $assignment_update->assignment_title=$request->assignment_title;
        $assignment_update->upload_date=$request->upload_date;
        $assignment_update->submit_date=$request->submit_date;
            $assignment_update->save();   
            $faculty_id=$request->session()->get('faculty_id')['id'];
            $faculty_subject_detail=['department_id'=>$request->department_id,'faculty_id'=>$request->faculty_id,'semester_id'=>$request->semester_id,'batch_id'=>$request->batch_id,'subject_id'=>$request->subject_id];
             $faculty_subject_detail_fetch=FacultySubject::where($faculty_subject_detail)->get();
            $faculty_subject_material_id=$faculty_subject_detail_fetch[0]->id;
            $faculty_assignment=Assignment::where("faculty_subject_id",$faculty_subject_material_id)->get();
            return view('faculty/faculty_assignment_upload',compact('faculty_subject_detail_fetch','faculty_assignment'));
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $assignment_delete=Assignment::find($id);
        if($assignment_delete->assignment_question)
        {
          unlink("assignment_question/".$assignment_delete->assignment_question);
        }
        $assignment_delete->delete();
         $faculty_subject_detail_fetch=FacultySubject::where('id',$assignment_delete->faculty_subject_id)->get();
        $faculty_subject_material_id=$assignment_delete->faculty_subject_id;
        $faculty_assignment=Assignment::where("faculty_subject_id",$faculty_subject_material_id)->get(); 
        return view('faculty/faculty_assignment_upload',compact('faculty_subject_detail_fetch','faculty_assignment'));
    }
}
