<?php

namespace App\Http\Controllers\admin;
use Session;
use File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Student;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $batch=Batch::pluck('batch_name','id')->all();  
        $student=Student::all();
        return view('admin/add_student',compact('batch','student'));

    }

    
    public function store(Request $request)
    {
        //
        if($request->profile)
        {
            $image=rand().$request->profile->getClientOriginalName();
            $request->profile->move(public_path('student_photos'),$image);
            $enrollment_number=$request->enrollment_number;
            $full_name=$request->full_name;
            $email=$request->email;
            $password = $request->password;
            $mobile_number=$request->mobile_number;
            $batch_id=$request->batch_id;
            Student::create([
            'enrollment_number'=>$enrollment_number,
            'full_name'=>$full_name,
            'email'=>$email,
            'password'=>$password,
            'mobile_number'=>$mobile_number,
            'batch_id'=>$batch_id,
            'profile'=>$image
            ]);
            return redirect('admin/add_student')->with('insert',"Add Successfully");
        }
        else{
            $enrollment_number=$request->enrollment_number;
            $full_name=$request->full_name;
            $email=$request->email;
            $password = $request->password;
            $mobile_number=$request->mobile_number;
            $batch_id=$request->batch_id;
            Student::create([
            'enrollment_number'=>$enrollment_number,
            'full_name'=>$full_name,
            'email'=>$email,
            'password'=>$password,
            'mobile_number'=>$mobile_number,
            'batch_id'=>$batch_id
        ]);
            return redirect('admin/add_student')->with('insert',"Add Successfully");
        }
    }

    public function update(Request $request, $id)
    {
        //
        $student_update=Student::find($id);
        if($request->profile)
        {
             if($student_update->profile)
             {
                unlink("student_photos/".$student_update->profile);
             } 
             $profile=rand().$request->profile->getClientOriginalName();
             $request->profile->move(public_path('student_photos'),$profile);
             $student_update->profile=$profile;
             $student_update->enrollment_number=$request->enrollment_number;
             $student_update->full_name=$request->full_name;
             $student_update->email=$request->email;
             $student_update->password = $request->password;
             $student_update->mobile_number=$request->mobile_number;
             $student_update->batch_id=$request->batch_id;
             $student_update->save();
        }
        else{
            $student_update->enrollment_number=$request->enrollment_number;
            $student_update->full_name=$request->full_name;
            $student_update->email=$request->email;
            $student_update->password = $request->password;
            $student_update->mobile_number=$request->mobile_number;
            $student_update->batch_id=$request->batch_id;
            $student_update->save();
        }
         return  redirect('admin/add_student')->with('update',"Update Successfully");
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
        $student_delete=Student::find($id);
        if($student_delete->profile)
        {
            unlink("student_photos/".$student_delete->profile);
        }
        $student_delete->delete();
        return  redirect('admin/add_student')->with('delete',"Delete Successfully");
    }
}
