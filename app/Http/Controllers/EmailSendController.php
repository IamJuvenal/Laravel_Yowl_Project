<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;

class EmailSendController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact-us');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $dataArray = [
          'full_name' => $request->input('name'),
          'subject' => "Reset Password",
          'email' => $request->input('email'),
          'password' => $request->input('password'),
        ];
		
		$sendToEmail = strtolower($request->input('email'));
		if(isset($sendToEmail) && !empty($sendToEmail) && filter_var($sendToEmail, FILTER_VALIDATE_EMAIL)){
			Mail::to($sendToEmail)->send(new ContactUsMail($dataArray));
		}
        
        return back()->with(['message' => 'Email successfully sent!']);
    }
}