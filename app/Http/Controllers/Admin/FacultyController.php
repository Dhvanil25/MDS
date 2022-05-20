<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty;
use Session;
use File;
use Redirect;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $faculty=Faculty::all();
        return view('admin/add_faculty',compact('faculty'));

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
        if($request->profile)
        {
            $image=rand().$request->profile->getClientOriginalName();
            $request->profile->move(public_path('faculty_photos'),$image);
            $full_name=$request->full_name;
            $email=$request->email;
            $password = $request->password;
            $mobile_number=$request->mobile_number;
            Faculty::create([
            'full_name'=>$full_name,
            'email'=>$email,
            'password'=>$password,
            'mobile_number'=>$mobile_number,
            'profile'=>$image
            ]);
            return redirect('admin/add_faculty')->with('insert',"Add Successfully");
        }
        else{
            $full_name=$request->full_name;
            $email=$request->email;
            $password = $request->password;
            $mobile_number=$request->mobile_number;
            Faculty::create([
            'full_name'=>$full_name,
            'email'=>$email,
            'password'=>$password,
            'mobile_number'=>$mobile_number,
        ]);
            return redirect('admin/add_faculty')->with('insert',"Add Successfully");
        }
    }
    public function update(Request $request, $id)
    {
        //
        $faculty_update=Faculty::find($id);
        if($request->profile)
        {
             if($faculty_update->profile)
             {
                unlink("faculty_photos/".$faculty_update->profile);
             } 
             $profile=rand().$request->profile->getClientOriginalName();
             $request->profile->move(public_path('faculty_photos'),$profile);
             $faculty_update->profile=$profile;
             $faculty_update->full_name=$request->full_name;
             $faculty_update->email=$request->email;
             $faculty_update->password = $request->password;
             $faculty_update->mobile_number=$request->mobile_number;
             $faculty_update->save();
        }
        else{
            $faculty_update->full_name=$request->full_name;
            $faculty_update->email=$request->email;
            $faculty_update->password = $request->password;
            $faculty_update->mobile_number=$request->mobile_number;
            $faculty_update->save();
        }
         return  redirect('admin/add_faculty')->with('update',"Update Successfully");
    }
    public function destroy($id)
    {
        //
        $faculty_delete=faculty::find($id);
        if($faculty_delete->profile)
        {
            unlink("faculty_photos/".$faculty_delete->profile);
        }
        $faculty_delete->delete();
        return  redirect('admin/add_faculty')->with('delete',"Delete Successfully");
    }
}
