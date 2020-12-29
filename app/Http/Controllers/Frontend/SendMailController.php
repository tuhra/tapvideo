<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SendMailController extends Controller
{
    public function send(Request $request)
    {
    	$this->validate($request, [
	      	'name'     =>  'required',
	      	'email'  =>  'required|email',
	      	'phone' => 'required|numeric',
            'subject'   =>  'required',
	      	'message' => 'required'
	    ]);
	    $data = array(
            'name'      =>  $request->name,
            'email'   =>  $request->email,
            'phone'   =>  $request->phone,
            'subject'   =>  $request->subject,
            'message'   =>  $request->message
        );

    	Mail::to($request->email)->send(new SendMail($data));
     	return back()->with('success', 'Thanks for contacting us!');
    }

}
