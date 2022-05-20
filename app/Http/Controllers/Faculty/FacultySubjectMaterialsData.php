<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacultySubjectMaterials;
use App\Models\FacultySubject;
class FacultySubjectMaterialsData extends Controller
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
         $request->all();
        if($request->material_pdf)
        {
            $pdf=rand().$request->material_pdf->getClientOriginalName();
            $request->material_pdf->move(public_path('materials'),$pdf);
            $department_id=$request->department_id;
            $faculty_id=$request->faculty_id;
            $batch_id=$request->batch_id;
            $semester_id=$request->semester_id;
            $subject_id=$request->subject_id;
            $faculty_subject_id=$request->faculty_subject_id;
            $material_title=$request->material_title;
            $material_description=$request->material_description;
            $material_video_url=$request->material_video_url;
            FacultySubjectMaterials::create([
                'faculty_id'=>$faculty_id,
                'faculty_subject_id'=>$faculty_subject_id,
                'batch_id'=>$batch_id,
                'semester_id'=>$semester_id,
                'subject_id'=>$subject_id,
                'material_title'=>$material_title,
                'material_description'=>$material_description,
                'material_video_url'=>$material_video_url,
                'material_pdf'=>$pdf
            ]);
             
    
        }
        else
        {
            
            $department_id=$request->department_id;
            $faculty_id=$request->faculty_id;
            $batch_id=$request->batch_id;
            $semester_id=$request->semester_id;
            $subject_id=$request->subject_id;
            $faculty_subject_id=$request->faculty_subject_id;
            $material_title=$request->material_title;
            $material_description=$request->material_description;
            $material_video_url=$request->material_video_url;
            FacultySubjectMaterials::create([
                'faculty_id'=>$faculty_id,
                'faculty_subject_id'=>$faculty_subject_id,
                'batch_id'=>$batch_id,
                'semester_id'=>$semester_id,
                'subject_id'=>$subject_id,
                'material_title'=>$material_title,
                'material_description'=>$material_description,
                'material_video_url'=>$material_video_url
            ]);
        }
            $faculty_subject_detail=['department_id'=>$department_id,'faculty_id'=>$faculty_id,'semester_id'=>$semester_id,'batch_id'=>$batch_id,'subject_id'=>$subject_id];
            $faculty_subject_detail_fetch=FacultySubject::where($faculty_subject_detail)->get();
            $faculty_subject_material_id=$faculty_subject_detail_fetch[0]->id;
            $faculty_material=FacultySubjectMaterials::where("faculty_subject_id",$faculty_subject_material_id)->get();
            return view('faculty/faculty_material_upload',compact('faculty_subject_detail_fetch','faculty_material'));
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
        // $id;
        $material_edit=FacultySubjectMaterials::find($id);
        $faculty_subject_detail_fetch=FacultySubject::where('id',$material_edit->faculty_subject_id)->get();
        $faculty_subject_material_id=$material_edit->faculty_subject_id;
        $faculty_material=FacultySubjectMaterials::where("faculty_subject_id",$faculty_subject_material_id)->get(); 
        return view('faculty/faculty_material_upload',compact('material_edit','faculty_subject_detail_fetch','faculty_material'));
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
        $material_update=FacultySubjectMaterials::find($id);
        if($request->material_pdf)
        {
            if($material_update->material_pdf)
            {
                unlink("materials/".$material_update->material_pdf);   
            }
            $pdf=rand().$request->material_pdf->getClientOriginalName();
            $request->material_pdf->move(public_path('materials'),$pdf);
            $material_update->material_title=$request->material_title;
            $material_update->material_video_url=$request->material_video_url;
            $material_update->material_description=$request->material_description;
            $material_update->material_pdf=$pdf;
            $material_update->save();
        }
        else{
            $material_update->material_title=$request->material_title;
            $material_update->material_video_url=$request->material_video_url;
            $material_update->material_description=$request->material_description;
            $material_update->save();   
        }
        $faculty_subject_detail_fetch=FacultySubject::where('id',$material_update->faculty_subject_id)->get();
        $faculty_subject_material_id=$material_update->faculty_subject_id;
        $faculty_material=FacultySubjectMaterials::where("faculty_subject_id",$faculty_subject_material_id)->get(); 
        return view('faculty/faculty_material_upload',compact('faculty_subject_detail_fetch','faculty_material'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $material_delete=FacultySubjectMaterials::find($id);
        if($material_delete->material_pdf)
        {
          unlink("materials/".$material_delete->material_pdf);
        }
        $material_delete->delete();
         $faculty_subject_detail_fetch=FacultySubject::where('id',$material_delete->faculty_subject_id)->get();
        $faculty_subject_material_id=$material_delete->faculty_subject_id;
        $faculty_material=FacultySubjectMaterials::where("faculty_subject_id",$faculty_subject_material_id)->get(); 
        return view('faculty/faculty_material_upload',compact('faculty_subject_detail_fetch','faculty_material'));
    }
}
