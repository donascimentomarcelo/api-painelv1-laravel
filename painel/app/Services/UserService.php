<?php

namespace Painel\Services;

use Painel\Models\User;
use Painel\Repositories\UserRepository;


class UserService 
{
  private $userRepository;

  public function __construct(UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function createUser(array $request)
  {
    $request['password'] = bcrypt($request['password']);
    
    $this->userRepository->create($request);
    
    return 1; 
  }

}