<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Mail;
use Validator;

class PagesController extends Controller
{
    
    public function index()
    {
        $pager = 'home';

        return view('home',compact('pager'));
    }

     
    public function about()
    {
        $pager = 'about';

        return view('about',compact('pager'));
    }

   public function products()
    {
        $pager = 'products';

        return view('products',compact('pager'));
    }

    public function careers()
    {
        $pager = 'careers';

        return view('careers',compact('pager'));
    }

    public function contact()
    {
        $pager = 'contact';

        return view('contact',compact('pager'));
    }
    //------------------------------------------------------------------
    public function contactSend(Request $request)
    {
        $pager = 'contact';

        $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email',
        'mobile' => 'required',
        'subject' => 'required',
        'message' => 'required',]); 

            
              $emails = array("sumesh@cdnrouters.com");
            
              $subject = ucwords($request->subject);
              $name = ucwords($request->name);

              $body = "Name: ".$name."\n\n"."Email: ".$request->email."\n\n"."Mobile: ".$request->mobile."\n\n -----------------------------------\n\n".$request->message;
              $from = $request->email;
              
             
            Mail::send([], [], function ($message) use($subject,$emails,$body,$from,$name) 
            {
               $message->from('webmaster@cdnrouters.com', 'CDN Web Contact Form');
               $message->replyTo($from, $name);
               $message->to($emails);
               $message->subject($subject);
               $message->setBody($body);
            });

        //return view('contact',compact('pager'))->with('status', 'Thank you for your words. We will contact you soon.');
        return redirect()->action('PagesController@contact')->with('status', 'Thank you for your words. We will contact you soon.');
    }
}
