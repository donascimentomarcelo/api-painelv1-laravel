<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\EmailRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PainelController extends Controller
{
	public function index()
	{
		return view('welcome');
	}
    public function email(EmailRequest $request)
    {
    	Mail::send('welcome', ['key' => 'value'], function($message)
    	{
    		 $message->to('marcelojunin2010@hotmail.com', 'Receiver Name')->subject('Laravel HTML Mail');
            
            $message->from('marcelojunin2010@hotmail.com','Our Code World');
    	});
    	return "Basic email sent, check your inbox.";
    }
}
