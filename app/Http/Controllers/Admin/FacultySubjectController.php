<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\FacultySubject;
class FacultySubjectController extends Controller
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
        $faculty=Faculty::pluck('full_name','id')->all();
        $faculty_subject=FacultySubject::all();
        return view('admin/add_subject_faculty',compact('department','faculty','faculty_subject'));
    }

    public function store(Request $request)
    {
        //
         $request->all();
        FacultySubject::create($request->all());
        return redirect('admin/add_subject_faculty')->with('insert',"Add Successfully");
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FacultySubject::find($id)->delete();
        return redirect('admin/add_subject_faculty')->with('delete',"delete Successfully");

    }
}
