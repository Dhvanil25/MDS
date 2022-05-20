<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
class SliderController extends Controller
{
    //
    public function index()
    {
        //
        $slider=Slider::all();
        return view('admin/add_slider',compact('slider'));
    }
    public function store(Request $request)
    {
        //
         $request->all();
        
            $image=rand().$request->image->getClientOriginalName();
            $request->image->move(public_path('slider'),$image);
            $title=$request->title;
            $status=$request->status;
            Slider::create([
            'title'=>$title,
            'status'=>$status,
            'image'=>$image,
            ]);
            return redirect('admin/add_slider')->with('insert',"Add Successfully");
        
    }
    public function update(Request $request, $id)
    {
        //
        $slider_update=Slider::find($id);
        if($request->image){
            if($request->image){
                unlink("slider/".$slider_update->image);
            }
         $image=rand().$request->image->getClientOriginalName();
            $request->image->move(public_path('slider'),$image);
            $slider_update->title=$request->title;
            $slider_update->image=$image;
            $slider_update->status=$request->status;
            $slider_update->save();
        }
        else{
            $slider_update->title=$request->title;
            $slider_update->status=$request->status;
//            $slider_update->save(); 
        }
        return redirect('admin/add_slider')->with('update',"update Successfully");
    }
    public function destroy($id)
    {
        //
        $slider_delete=Slider::find($id);
        if($slider_delete->image)
        {
            unlink("slider/".$slider_delete->image);
        }
        $slider_delete->delete();
        return  redirect('admin/add_slider')->with('delete',"Delete Successfully");
    }
}
