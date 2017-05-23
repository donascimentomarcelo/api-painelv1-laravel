<?php

namespace Painel\Services;

use Painel\Models\Email;
use Painel\Repositories\EmailRepository;

class EmailService 
{
	private $emailRepository;

	public function __construct(EmailRepository $emailRepository)
	{
		$this->emailRepository = $emailRepository;
	}

	
}