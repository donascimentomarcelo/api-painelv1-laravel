<?php

namespace Painel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Painel\Http\Controllers\Controller;
use Painel\Http\Requests;
use Painel\Http\Requests\NewsRequest;
use Painel\Repositories\EmailRepository;
use Painel\Repositories\NewsRepository;
use Painel\Services\EmailService;


class EmailController extends Controller
{
    private $emailRepository;
    private $emailService;
    private $newsRepository;

    public function __construct(EmailRepository $emailRepository, EmailService $emailService, NewsRepository $newsRepository)
    {
        $this->emailRepository = $emailRepository;
        $this->emailService = $emailService;
        $this->newsRepository = $newsRepository;
    }

    // public function create(Request $request)
    // {
    //     return $this->emailService->emailConfirmation($request->all());
   
    // }

    public function emailConfirmation($id)
    {
        $this->emailRepository->find($id);

        $this->emailService->updateStatusConfirmation($id);
        
        return redirect()->route('emails.success');
    }

    public function editStatusEmail($id)
    {
        $emails =  $this->emailRepository->find($id);

        return view('admin.email.edit', compact('emails'));
    }

    public function updateStatusEmail($id)
    {
        $this->emailRepository->update();
    }

    public function show()
    {
        $emails = $this->emailRepository->paginate(10);

        return view('admin.email.list', compact('emails'));
    }

    public function sendEmail(NewsRequest $request)
    {
        $this->newsRepository->create($request->all());
        
        $this->emailService->sendService($request->all());

        return redirect()->route('admin.painel.news.list');
    }

    public function updateSendEmail(NewsRequest $request, $id)
    {
        $this->newsRepository->update($request->all(), $id);

        $this->emailService->sendService($request->all());

        return redirect()->route('admin.painel.news.list');
    }

   

}
