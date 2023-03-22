<?php

namespace App\Http\Controllers\Home;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlide;
use Image;





class HomeSlideController extends Controller
{
    public function home(){
        return redirect()->intended(RouteServiceProvider::HOME);
    }//End Method

    public function Homepage(){
        return view('frontend.index');
    }//End Method
    public function homeslider(){
        $homeslide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all', compact('homeslide'));
    }//End Method


    public function updateslide(Request $request){
        $slide_id = $request->id;
        //For storing image
        if ($request->file('home_slide')) {
            $image =  $request->file('home_slide');
            $img_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  //Eg:3545567.png
            Image::make($image)->resize(636, 852)->save('upload/home_slide/' . $img_name);
            $save_url = 'upload/home_slide/' . $img_name;

            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
                'home_slide' => $save_url,
            ]);

        $notification = array(
            'message' => 'Home Slide Updated With image successfully',
            'alert-type' =>'success'

        );
        return redirect()->back()->with($notification);
        }else {
            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
            ]);

        $notification = array(
            'message' => 'Home Slide Updated Without image successfully',
            'alert-type' =>'success'

        );
        return redirect()->back()->with($notification);

        }


    }//End Method
}
