<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty;
class FacultyAuthController extends Controller
{
    //
    public function login()
    {
        return view('faculty.login');
    }
    public function check(Request $request)
    {
        $data=Faculty::where(['email'=>$request->email,'password'=>$request->password])->first();
        if($data){
            $request->session()->put('faculty_id',$data);
            return redirect('faculty/index');
        }
        else
        {
            return back()->with('fail','Invalid Username or  Password');
        }
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('faculty/login');
    }
}
