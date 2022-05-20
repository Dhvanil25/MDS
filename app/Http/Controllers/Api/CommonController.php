<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
class CommonController extends Controller
{
    //
    public function slider()
    {
        $slider=Slider::all();
        if(count($slider)>0)
        {
           return response()->json($slider, 200,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
               JSON_UNESCAPED_UNICODE);
        }
        else
        {
           return response()->json($slider, 200,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
           JSON_UNESCAPED_UNICODE);
        }
    }
}
