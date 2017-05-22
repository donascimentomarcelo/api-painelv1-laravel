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


class ImageController extends Controller
{
    private $uploadsRepository;
    private $projectsRepository;

    public function __construct(UploadsRepository $uploadsRepository, ProjectsRepository $projectsRepository)
    {
        $this->uploadsRepository = $uploadsRepository;
        $this->projectsRepository = $projectsRepository;
    }

    public function editImage($id)
    {
        $upload = $this->uploadsRepository->skipPresenter()->find($id);

        return view('admin.image.image', compact('upload'));
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
        $dataImage = $this->uploadsRepository->skipPresenter()->find($id);

        $this->projectService->updateImage($files, $id, $dataImage);

        return redirect()->route('admin.image.projectlist');
          
    }

    public function deleteImage($id)
    {
        $upload = $this->uploadsRepository->skipPresenter()->find($id);

        return view('admin.image.delete', compact('upload'));
    }

    public function destroyImage($id)
    {
        $upload = $this->uploadsRepository->skipPresenter()->find($id);

        $this->projectService->removeUpload($upload);

        return redirect()->route('admin.image.projectlist');
    }

    public function addImage($id)
    {
        $projects = $this->projectRepository->skipPresenter()->find($id);

        return view('admin.image.add', compact('projects'));
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
        return redirect()->route('admin.image.projectlist');

    }

    public function indexMultiple($id)
    {
        $uploads = $this->projectsRepository->skipPresenter()->find($id);

        return view('admin.image.orderMultiple', compact('uploads'));
    }

    public function updateMultiple(Request $request, $id)
    {
        foreach($request as $data)
        {
        echo '<pre>';
        echo var_dump($data);
        echo '</pre>';
            
        }
    }
   
}
