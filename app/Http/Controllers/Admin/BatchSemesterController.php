<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Batch;
use App\Models\BatchSemesters;
class BatchSemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $batchsemester=BatchSemesters::all();
       $department=Department::pluck('department_name','id')->all();  
        return view('admin/add_batch_semester',compact('department','batchsemester'));
    }
    public function store(Request $request)
    {
        //
        BatchSemesters::create($request->all());
        return redirect('admin/add_batch_semester')->with('insert',"Add Successfully"); 
    }

    
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
        //
        BatchSemesters::find($id)->delete();
        return redirect('admin/add_batch_semester')->with('delete',"delete Successfully");
    }
}
