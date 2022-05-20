<?php

namespace App\Http\Controllers\AdminAuth;
use App\Models\User;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login()
    {
        return view('admin.login');
    }
    public function check(Request $request)
    {
        $data=User::where(['email'=>$request->email,'password'=>$request->password])->first();
        if($data){
            $request->session()->put('LogginId',$data);
            return redirect('admin/index');
        }
        else
        {
            return back()->with('fail','Invalid Username or  Password');
        }
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('admin/login');
    }
}
