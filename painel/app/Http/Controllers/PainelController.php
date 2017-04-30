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
    	$send = Mail::send('welcome', ['key' => 'value'], function($message)
    	{
    		 $message->to('marcelo.cyborgs@gmail.com', 'Receiver Name')->subject('Laravel HTML Mail teste');
            
            $message->from('marcelo.cyborgs@gmail.com','Our Code World');
    	});
        if(!$send)
        {
            return 0;
        }
    	return 1;
    }
}
