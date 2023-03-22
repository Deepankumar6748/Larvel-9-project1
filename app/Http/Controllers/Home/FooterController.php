<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Footer;



class FooterController extends Controller
{
    public function footersetup(){
        $footerpage = Footer::find(1);
        return view('admin.footer_page.footer_all', compact('footerpage'));
    }

    public function updatefooter(Request $request){
        $footer_id = $request->id;
        Footer::findOrFail($footer_id)->update([
            'number' => $request->number,
            'short_description' => $request->short_description,
            'address' => $request->address,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'twitter' =>  $request->twitter,
            'copyrights' =>  $request->copyrights,
        ]);

    $notification = array(
        'message' => 'Footer page Updated  successfully',
        'alert-type' =>'success'

    );
    return redirect()->back()->with($notification);
    }
}
