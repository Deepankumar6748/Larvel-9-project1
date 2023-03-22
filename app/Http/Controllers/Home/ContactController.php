<?php

namespace App\Http\Controllers\Home;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PhpParser\Node\Stmt\Return_;

class ContactController extends Controller
{
    public function contactpage(){
        return view('frontend.contactpage');
    }
    public function sendmessage(Request $request){
        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'budget' => $request->budget,
            'message' => $request->message,
            'created_at'=>Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Message sent successfully',
            'alert-type' =>'success'

        );
        return redirect()->back()->with($notification);
    }//End Method

    public function contactmessage(){
        $contactmsg = Contact::latest()->get();
        return view('admin.contact.contactmsg',compact('contactmsg'));
    }//End Method

    public function deletemessage($id){

         Contact::findOrFail($id)->delete();

         $notification = array(
             'message' => 'Message  Deleted  successfully',
             'alert-type' =>'success'
         );
         return redirect()->back()->with($notification);
     }//End Method
}
