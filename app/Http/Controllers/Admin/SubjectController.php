<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Semester;
use App\Models\Subject;
class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $department=Department::pluck('department_name','id')->all();
        $semester=Semester::pluck('semester','id')->all();
        $subject=Subject::all();
        return view('admin/add_subject',compact('department','semester','subject'));
    }
    public function store(Request $request)
    {
        //
         $request->all();
        
            $syllabus=rand().$request->subject_syllabus->getClientOriginalName();
            $request->subject_syllabus->move(public_path('syllabus'),$syllabus);
            $department_id=$request->department_id;
            $semester_id=$request->semester_id;
            $subject_name=$request->subject_name;
            $subject_code = $request->subject_code;
            $subject_pratical=$request->subject_pratical;
            $subject_theory=$request->subject_theory;
            $subject_syllabus=$request->subject_syllabus;
            $codemirror_name=$request->codemirror_name;
            $api_language=$request->api_language;
            Subject::create([
            'department_id'=>$department_id,
            'semester_id'=>$semester_id,
            'subject_name'=>$subject_name,
            'subject_code'=>$subject_code,
            'subject_pratical'=>$subject_pratical,
            'subject_theory'=>$subject_theory,
            'subject_syllabus'=>$department_id.$semester_id.$syllabus,
            'codemirror_name'=>$codemirror_name,
            'api_language'=>$api_language,
            ]);
            return redirect('admin/add_subject')->with('insert',"Add Successfully");
        
    }
    public function update(Request $request, $id)
    {
        //
        $subject_update=Subject::find($id);
        if($request->subject_syllabus){
            if($request->syllabus){
                unlink("syllabus/".$subject_update->subject_syllabus);
            }
        $syllabus=rand().$request->subject_syllabus->getClientOriginalName();
            $request->subject_syllabus->move(public_path('syllabus'),$syllabus);
            $subject_update->department_id=$request->department_id;
            $subject_update->semester_id=$request->semester_id;
            $subject_update->subject_name=$request->subject_name;
            $subject_update->subject_code = $request->subject_code;
            $subject_update->subject_pratical=$request->subject_pratical;
            $subject_update->subject_theory=$request->subject_theory;
            $subject_update->subject_syllabus=$syllabus;
            $subject_update->api_language=$request->api_language;
            $subject_update->codemirror_name=$request->codemirror_name;
            $subject_update->save();
        }
        else{
            $subject_update->department_id=$request->department_id;
            $subject_update->semester_id=$request->semester_id;
            $subject_update->subject_name=$request->subject_name;
            $subject_update->subject_code = $request->subject_code;
            $subject_update->subject_pratical=$request->subject_pratical;
            $subject_update->subject_theory=$request->subject_theory;
            $subject_update->subject_syllabus=$subject_update->subject_syllabus;
            $subject_update->api_language=$request->api_language;
            $subject_update->codemirror_name=$request->codemirror_name;
            //subject_syllabus
            $subject_update->save(); 
        }
        return redirect('admin/add_subject')->with('update',"update Successfully");
    }
    public function destroy($id)
    {
        //
        $subject_delete=Subject::find($id);
        if($subject_delete->subject_syllabus)
        {
            unlink("syllabus/".$subject_delete->subject_syllabus);
        }
        $subject_delete->delete();
        return  redirect('admin/add_subject')->with('delete',"Delete Successfully");
    }
}
