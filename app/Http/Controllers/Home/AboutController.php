<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\multiImage;
use Image;


class AboutController extends Controller
{
    public function aboutpage(){
        $aboutpage = About::find(1);
        return view('admin.about_page.about_page_all', compact('aboutpage'));
    }//End Method


    public function updateabout(Request $request){
        $about_id = $request->id;
        //For storing image
        if ($request->file('about_image')) {
            $image =  $request->file('about_image');
            $img_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  //Eg:3545567.png
            Image::make($image)->resize(523, 605)->save('upload/about_images/' . $img_name);
            $save_url = 'upload/about_images/' . $img_name;

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' =>  $save_url,
            ]);

        $notification = array(
            'message' => 'About page Updated With image successfully',
            'alert-type' =>'success'

        );
        return redirect()->back()->with($notification);
        }else {
            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
            ]);

        $notification = array(
            'message' => 'About Page Updated Without image successfully',
            'alert-type' =>'success'

        );
        return redirect()->back()->with($notification);

        }


    }//End Method

    public function homeabout(){
        $homeabout = About::find(1);
        return view('frontend.aboutpage',compact('homeabout'));   //here we directly give access to the file "frontend.home_about" to database by passing variable to the page using compact() method.
    }//End Method


    public function aboutmultiimage(){
        return view('admin.about_page.multiimage');
    }//End Method

    public function storemultiimage(Request $request){
        $request->validate([
            'multi_images' => 'required',
        ], [
                'multi_images.required' => 'Insert any Multi image To Update',
            ]);

        $image =  $request->file('multi_images');
        foreach ($image as $multiimages) {    //for dealing with multi data we have to use foreach()
            $img_name = hexdec(uniqid()).'.'.$multiimages->getClientOriginalExtension();  //Eg:3545567.png
            Image::make($multiimages)->resize(220, 220)->save('upload/multi_images/' . $img_name);
            $save_url = 'upload/multi_images/' . $img_name;

            multiImage::insert([
                'multi_images' =>  $save_url,

            ]);

        }
        $notification = array(
            'message' => 'Multi image Inserted successfully',
            'alert-type' =>'success'

        );
        return redirect()->route('all.multi.image')->with($notification);
    }//End Method



    public function allmultiimage(){   //to show all the images we create a data  table in the frontend
        $all_multiimage = multiImage::all();
        return view('admin.about_page.all_multiimage',compact('all_multiimage'));
    }//End Method


    public function editmultiimage($id){
        $multiimage = multiImage::findOrFail($id);
        return view('admin.about_page.edit_multiimage',compact('multiimage'));
    }//End Method


    public function updatemultiimage(Request $request){
        $multiimage_id = $request->id;
        //For storing image
        if ($request->file('multi_images')) {
            $image =  $request->file('multi_images');
            $img_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  //Eg:3545567.png
            Image::make($image)->resize(220, 220)->save('upload/multi_images/' . $img_name);
            $save_url = 'upload/multi_images/' . $img_name;

            multiImage::findOrFail($multiimage_id)->update([
                'multi_images' =>  $save_url,
            ]);

        $notification = array(
            'message' => 'Image  in Multi Images is Updated  successfully',
            'alert-type' =>'success'

        );
        return redirect()->route('all.multi.image')->with($notification);
        }
    }//End Method


    public function deletemultiimage($id){
       $multi= multiImage::findOrFail($id);
       $img = $multi->multi_images;
        unlink($img);
        multiImage::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Image  Deleted  successfully',
            'alert-type' =>'success'
        );
        return redirect()->back()->with($notification);
    }//End Method
}
