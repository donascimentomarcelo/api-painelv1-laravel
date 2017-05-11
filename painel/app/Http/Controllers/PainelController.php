<?php

namespace Painel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Painel\Http\Controllers\Controller;
use Painel\Http\Requests;
use Painel\Http\Requests\EmailRequest;
use Painel\Http\Requests\UserRequest;
use Painel\Models\User;
use Painel\Repositories\UserRepository;
use Painel\Services\ProjectService;



class PainelController extends Controller
{
    private $user;
    private $projectService;

    public function __construct(UserRepository $user, ProjectService $projectService)
    {
        $this->user = $user;
        $this->projectService = $projectService;
    }


	public function index()
	{
		return view('admin.painel.index');
	}

    public function createUser()
    {
        return view('admin.painel.create-user');
    }

    public function saveUser(UserRequest $userRequest)
    {
        $this->user->create($userRequest->all());
          
        return redirect()->route('admin.painel.userlist');
    }

    public function listUser()
    {
        $users = $this->user->paginate(5);

        return view('admin.painel.list-user', compact('users'));
    }

    public function createProject()
    {
        return view('admin.project.create-project');
    }

    public function saveProject(request $request)
    {
        $files = Input::file('images');
        $return = $this->projectService->save($files, $request);
        dd($return);
    }

    public function listProject()
    {
        
    }

    public function email(EmailRequest $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $description = $request->input('description');
        $subject = $request->input('subject');

    	$send = Mail::send('email.contact', $request->all(), function($message) use($name, $email, $description, $subject)
    	{
    		$message->to('marcelojunin2010@hotmail.com', 'Marcelo Nascimento')->subject($subject);
            
            $message->from($email, $name);
    	});
        if(!$send)
        {
            return 0;
        }
    	return 1;
    }
}
