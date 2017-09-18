<?php

namespace Painel\Services;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Painel\Models\Uploads;
use Painel\Repositories\ProjectsRepository;
use Painel\Repositories\UploadsRepository;
use Painel\Services\UploadService;


class ProjectService 
{
  private $uploadsRepository;
  private $projectsRepository;
  private $uploadService;

  public function __construct(UploadsRepository $uploadsRepository, ProjectsRepository $projectsRepository, UploadService $uploadService)
  {
    $this->uploadsRepository = $uploadsRepository;
    $this->projectsRepository = $projectsRepository;
    $this->uploadService = $uploadService;
  }

    public function save($files, $id)
    {
        if(is_object($id))
        {
          $id = $id->id;
        }

        $entityManager = new Uploads();
        $arr = $this->uploadService->doUpload($files, $entityManager);
        foreach($arr as $entry)
        {
          $entry->projects_id = $id;
          $entry->save();
        }

        $result = $this->projectsRepository->find($id);

        $result['status'] = 1;

        return $result;
    }

    public function updateImage($files, $id, $dataImage)
    {
         $this->uploadService->destroyImageInStorage($dataImage);

         $entityManager = new Uploads();
         $arr = $this->uploadService->doUpload($files, $entityManager);

         foreach ($arr as $key) {
          $key = array(
            'filename' => $key->filename,
            'original_filename'=> $key->original_filename,
            'mime'=> $key->mime,
            );

          Uploads::where('id', $id)->update($key);
         }

         return  $this->uploadsRepository->find($id);

    }

    public function removeUpload($upload)
    {

      try {

        $this->uploadService->destroyImageInStorage($upload);

        Uploads::where('original_filename', $upload->original_filename)->delete();

        return 1;

      } catch (Exception $e) {

        throw $e;
      
      }

    }

    public function validateFiles($files)
    {
        foreach($files as $file) {
          $rules = array('file' => 'required|mimes:png,jpeg,jpg'); 
          $validator = Validator::make(array('file'=> $file), $rules);
         return $validator;
        }
    }

    public function validateProject(array $project)
    {
      $validator = Validator::make($project,[
        'name'       =>'required|max:50',
        'category'   =>'required|max:50',
        'link'       =>'required|max:50',
        'description'=>'required|max:255'
        ], [
        'required' => 'O campo :attribute é obrigatório!',
        ], [
        'name'        => 'Nome',
        'category'    => 'Categoria',
        'link'        => 'Link',
        'description' => 'Descrição'

        ]);
      if($validator->fails()){
            $error['message'] = $validator->messages();
            $error['status'] = 333;
            return $error;
        }
    }
}