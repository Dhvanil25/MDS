<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
class AuthController extends Controller
{
    
    //
    public function login(Request $req){

        $rules=[
            'enrollment_number'=>'required',
            'password'=>'required'
        ];
        $req->validate($rules);
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user=Student::where(['enrollment_number'=>$req->enrollment_number,'password'=>$req->password])->first();
        if($user){
            $token=$user->createToken('Personal Access Token')->plainTextToken;
            $response=['user'=>$user,'token'=>$token];
            //return response()->json($response, 200);
            return response()->json($response, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }
        $response=['message'=>'Enter Valid Enrollment or Password'];
        //return response()->json($response, 400);
        return response()->json($response, 400,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
    }
    public function login2(){
        return "hello";
    }
}
