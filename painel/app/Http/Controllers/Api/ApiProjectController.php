<?php

namespace Painel\Http\Controllers\Api;

use Illuminate\Http\Request;
use Painel\Http\Controllers\Controller;
use Painel\Http\Requests;
use Painel\Repositories\ProjectsRepository;


class ApiProjectController extends Controller
{
    private $projectRepository;

    public function __construct(ProjectsRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }


    public function ApiListProject()
    {
        $projects = $this->projectRepository->all();

        return $projects;
    }
}
