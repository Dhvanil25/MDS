<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;
class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $semester=Semester::all();
        return view('admin/add_semester',compact('semester'));
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
            $image=rand().$request->semester_image->getClientOriginalName();
            $request->semester_image->move(public_path('semester_photo'),$image);
            Semester::create([
            'semester'=>$semester,
            'semester_image'=>$image
            ]);
            return redirect('admin/add_semester')->with('insert',"Add Successfully");
        }
        else{
            $semester=$request->semester;
          
            Semester::create([
            'semester'=>$semester,
        ]);
            return redirect('admin/add_semester')->with('insert',"Add Successfully");
        }

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
        $semester_update=Semester::find($id);
        if($request->semester_image)
        {
             if($semester_update->semester_image)
             {
                unlink("semester_photo/".$semester_update->semester_image);
             } 
             $image=rand().$request->semester_image->getClientOriginalName();
             $request->semester_image->move(public_path('semester_photo'),$image);
             $semester_update->semester_image=$image;
             $semester_update->semester=$semester_update->semester;
             $semester_update->save();
        }
        else{
            $semester_update->semester=$semester_update->semester;
            $semester_update->save();
        }
         return  redirect('admin/add_semester')->with('update',"Update Successfully");

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
        $semester_delete=Semester::find($id);
        if($semester_delete->semester_image)
        {
            unlink("semester/".$semester_delete->semester_image);
        }
        $faculty_delete->delete();
        return  redirect('admin/add_semester')->with('delete',"Delete Successfully");

    }
}
