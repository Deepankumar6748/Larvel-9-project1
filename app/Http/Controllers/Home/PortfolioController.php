<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Image;

class PortfolioController extends Controller
{
    public function allportfolio(){
        $portfolio = Portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all',compact('portfolio'));
    }//End Method

    public function addportfolio(){
        return view('admin.portfolio.portfolio_add');
    }//End Method

    public function storeportfolio(Request $request){
        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',

        ], [
                'portfolio_name.required' => 'Portfolio Name Field is Required',
                'portfolio_title.required' => 'Portfolio Title Field is Required',
            ]);

            $image =  $request->file('portfolio_image');
            $img_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  //Eg:3545567.png
            Image::make($image)->resize(1020, 519)->save('upload/portfolio_image/' . $img_name);
            $save_url = 'upload/portfolio_image/' . $img_name;

            Portfolio::insert([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image' =>  $save_url,
            ]);

        $notification = array(
            'message' => 'Data  is Inserted  successfully',
            'alert-type' =>'success'

        );
        return redirect()->route('all.portfolio')->with($notification);


    }//End Method

    public function editportfolio($id){
            $portfolio_edit = Portfolio::findOrFail($id);
            return view('admin.portfolio.edit_portfolio',compact('portfolio_edit'));


    }//End Method
    public function updateportfolio(Request $request){
        $portfolio_id = $request->id;
        if ($request->file('portfolio_image')) {
            $image =  $request->file('portfolio_image');
            $img_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  //Eg:3545567.png
            Image::make($image)->resize(1020, 519)->save('upload/portfolio_image/' . $img_name);
            $save_url = 'upload/portfolio_image/' . $img_name;

            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image' => $save_url,
            ]);

        $notification = array(
            'message' => 'Portfolio Data Updated With image successfully',
            'alert-type' =>'success'

        );
        return redirect()->route('all.portfolio')->with($notification);
        }else {
            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
            ]);

        $notification = array(
            'message' => 'Portfolio Data Updated Without image successfully',
            'alert-type' =>'success'

        );
        return redirect()->route('all.portfolio')->with($notification);

        }

    }//End Method

    public function deleteportfolio($id){
        $port_folio= Portfolio::findOrFail($id);
        $img = $port_folio->portfolio_image;
         unlink($img);
         Portfolio::findOrFail($id)->delete();



         $notification = array(
             'message' => ' Portfolio Data  Deleted  successfully',
             'alert-type' =>'success'
         );
         return redirect()->back()->with($notification);
     }//End Method


     public function portfoliodetails(){
        return view('frontend.portfolio_details');
     }//End Method
}
