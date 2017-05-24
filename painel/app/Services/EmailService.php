<?php

namespace Painel\Services;

use Illuminate\Support\Facades\Mail;
use Painel\Repositories\EmailRepository;

class EmailService 
{
	private $emailRepository;

	public function __construct(EmailRepository $emailRepository)
	{
		$this->emailRepository = $emailRepository;
	}

	public function sendService($request)
	{
		$description = $request['description'];
		$subject = $request['subject'];
		$title = $request['title'];

		$emails = $this->emailRepository->EmailByStatus();

		foreach ($emails as $email) 
		{

			$send = Mail::send('email.email-multiple', $request, function($message) use($email, $description, $subject, $title)
			{
				$message->to($email)->subject($subject);
				
				$message->from('marcelojunin2010@hotmail.com', 'Marcelo Nascimento');
			});

		}

		return;
	}
}
