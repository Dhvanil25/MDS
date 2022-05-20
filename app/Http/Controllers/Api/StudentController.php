<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
class StudentController extends Controller
{
    //
    public function getStuentDetail($id)
    {
        //
        $stud=Student::where(['id'=>$id])->first(); 
        return $stud;
        if($stud){
            return response()->json($stud, 200,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }
    }
}
