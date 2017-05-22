<?php

namespace Painel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Painel\Http\Controllers\Controller;
use Painel\Http\Requests;
use Painel\Http\Requests\ImageRequest;
use Painel\Http\Requests\OrderImageRequest;
use Painel\Repositories\ProjectsRepository;
use Painel\Repositories\UploadsRepository;
use Painel\Services\ImageService;
use Painel\Services\ProjectService;


class ImageController extends Controller
{
    private $uploadsRepository;
    private $projectsRepository;
    private $imageService;
    private $projectService;

    public function __construct(UploadsRepository $uploadsRepository, ProjectsRepository $projectsRepository, ImageService $imageService, ProjectService $projectService)
    {
        $this->uploadsRepository = $uploadsRepository;
        $this->projectsRepository = $projectsRepository;
        $this->imageService = $imageService;
        $this->projectService = $projectService;
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

        $projects = $this->returnToEdit($id);

        return view('admin.project.edit', compact('projects'));

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

        $id_project = $upload->projects->id;

        $projects = $this->projectsRepository->skipPresenter()->find($id_project);

        return view('admin.project.edit', compact('projects'));
    }

    public function addImage($id)
    {
        $projects = $this->projectsRepository->skipPresenter()->find($id);

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
        return redirect()->route('admin.painel.projectlist');

    }

    public function indexMultiple($id)
    {
        $uploads = $this->projectsRepository->skipPresenter()->find($id);

        return view('admin.image.orderMultiple', compact('uploads'));
    }

    public function updateMultiple(Request $request, $id)
    {
        $this->imageService->updateMultipleImage($request);

        $projects = $this->projectsRepository->skipPresenter()->find($id);

        return view('admin.project.edit', compact('projects'));
    }

    public function indexSingle($id)
    {
        $uploads = $this->uploadsRepository->skipPresenter()->find($id);

        return view('admin.image.order', compact('uploads'));
    }

    public function updateSingle(Request $request, $id)
    {

        $this->imageService->updateSingleImage($request, $id);

        $projects = $this->returnToEdit($id);

        return view('admin.project.edit', compact('projects'));
    }

    public function returnToEdit($id)
    {
        $uploads = $this->uploadsRepository->skipPresenter()->find($id);

        $id_project = $uploads->projects->id;

        return $projects = $this->projectsRepository->skipPresenter()->find($id_project);
    }
   
}
