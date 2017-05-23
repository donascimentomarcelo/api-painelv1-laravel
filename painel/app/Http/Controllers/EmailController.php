<?php

namespace Painel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Painel\Http\Controllers\Controller;
use Painel\Http\Requests;
use Painel\Repositories\EmailRepository;
use Painel\Services\EmailService;


class EmailController extends Controller
{
    private $emailRepository;
    private $emailService;

    public function __construct(EmailRepository $emailRepository, EmailService $emailService)
    {
        $this->emailRepository = $emailRepository;
        $this->emailService = $emailService;
    }

    public function listEmail()
    {
        
    }
    
    public function saveEmail()
    {
        
    }

    public function sendEmail()
    {
        $emails = $this->emailRepository->EmailByStatus();
        $description = 'teste';
        $subject = 'teste';

        $data = array('description'=>$description, 'subject'=>$subject, 'email'=>$emails);

        foreach ($emails as $email) 
        {

            $send = Mail::send('email.email-multiple', $data, function($message) use($email, $description, $subject)
            {
                $message->to('marcelojunin2010@hotmail.com', 'Marcelo Nascimento')->subject($subject);

                $message->from($email);
            });

            if(!$send)
            {
                return 0;
            }
            return 1;
        }
    }


}
