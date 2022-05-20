<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacultyProgram;
use App\Models\FacultySubject;
use App\Models\Subject;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
         // $request->all();
        FacultyProgram::create($request->all());
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
        $program_edit=FacultyProgram::find($id);
        $faculty_subject_detail_fetch=FacultySubject::where('id',$program_edit->faculty_subject_id)->get();
        $faculty_subject_material_id=$program_edit->faculty_subject_id;
        $faculty_program=FacultyProgram::where("faculty_subject_id",$faculty_subject_material_id)->get(); 
        return view('faculty/faculty_program_upload',compact('faculty_subject_detail_fetch','faculty_program','program_edit'));       
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
        //return $request->all();
        FacultyProgram::find($id)->update($request->all());

       $program_edit=FacultyProgram::find($id);
        $faculty_subject_detail_fetch=FacultySubject::where('id',$program_edit->faculty_subject_id)->get();
        $faculty_subject_material_id=$program_edit->faculty_subject_id;
        $faculty_program=FacultyProgram::where("faculty_subject_id",$faculty_subject_material_id)->get(); 
        return view('faculty/faculty_program_upload',compact('faculty_subject_detail_fetch','faculty_program'));
        
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
        $program_delete=FacultyProgram::find($id);
        $program_delete->delete();
        $faculty_subject_detail_fetch=FacultySubject::where('id',$program_delete->faculty_subject_id)->get();
        $faculty_subject_material_id=$program_delete->faculty_subject_id;
        $faculty_program=FacultyProgram::where("faculty_subject_id",$faculty_subject_material_id)->get(); 
        return view('faculty/faculty_program_upload',compact('faculty_subject_detail_fetch','faculty_program'));
    }
}
