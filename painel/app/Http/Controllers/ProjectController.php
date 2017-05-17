<?php

namespace Painel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Painel\Http\Controllers\Controller;
use Painel\Http\Requests;
use Painel\Http\Requests\ImageRequest;
use Painel\Repositories\ProjectsRepository;
use Painel\Repositories\UploadsRepository;
use Painel\Services\ProjectService;

class ProjectController extends Controller
{  
    private $projectService;
    private $projectRepository;
    private $uploadRepository;

    public function __construct(ProjectService $projectService, ProjectsRepository $projectRepository, UploadsRepository $uploadRepository)
    {
        $this->projectService = $projectService;
        $this->projectRepository = $projectRepository;
        $this->uploadRepository = $uploadRepository;
    }
     public function createProject()
    {
        return view('admin.project.create-project');
    }

    public function saveProject(Request $request)
    {
        $files = Input::file('images');
        $validator = $this->projectService->validateFiles($files);
        if($validator->fails()){
            return redirect('project/save')
                        ->withErrors($validator)
                        ->withInput();
          }
        $id = $this->projectRepository->create($request->all());
        $return = $this->projectService->save($files, $id);
        return redirect()->route('admin.painel.projectlist');
    }

    public function editProject($id)
    {
        $projects = $this->projectRepository->skipPresenter()->find($id);

        return view('admin.project.edit', compact('projects'));
    }

    public function updateProject(Request $request, $id)
    {
        $this->projectRepository->update($request->all(), $id);

        return redirect()->route('admin.painel.projectlist');
    }

    public function listProject()
    {
        $projects = $this->projectRepository->skipPresenter()->paginate(5);

        return view('admin.project.list-project', compact('projects'));
    }

    public function editImage($id)
    {
        $upload = $this->uploadRepository->skipPresenter()->find($id);

        return view('admin.project.image', compact('upload'));
    }

    public function updateImage($id, Request $request)
    {
        $files = Input::file('images');
        $validator = $this->projectService->validateFiles($files);
          if($validator->fails()){
            return redirect('admin/image/edit/'.$id)
                        ->withErrors($validator)
                        ->withInput();
          }
        $this->projectService->updateImage($files, $id);

        return redirect()->route('admin.painel.projectlist');
          
    }

    public function deleteImage($id)
    {
        $upload = $this->uploadRepository->skipPresenter()->find($id);

        return view('admin.project.delete', compact('upload'));
    }

    public function destroyImage($id)
    {
        $upload = $this->uploadRepository->skipPresenter()->find($id);

        $this->projectService->removeUpload($upload);

        return redirect()->route('admin.painel.projectlist');
    }

    public function addImage($id)
    {
        $projects = $this->projectRepository->skipPresenter()->find($id);

        return view('admin.project.add', compact('projects'));
    }

    public function saveImage($id)
    {
        $files = Input::file('images');
        $validator = $this->projectService->validateFiles($files);
          if($validator->fails()){
            return redirect('admin/image/add/'.$id)
                        ->withErrors($validator)
                        ->withInput();
          }
        $return = $this->projectService->save($files, $id);
        return redirect()->route('admin.painel.projectlist');

    }

}
