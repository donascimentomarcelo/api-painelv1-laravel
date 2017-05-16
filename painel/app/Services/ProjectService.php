<?php

namespace Painel\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Painel\Models\Uploads;
use Painel\Repositories\UploadsRepository;



class ProjectService 
{
  private $uploadsRepository;

  public function __construct(UploadsRepository $uploadsRepository)
  {
    $this->uploadsRepository = $uploadsRepository;
  }



    public function way()
    {
        return 'http://localhost:8000/uploads/project/';
    }

    public function save($files, $id)
    {
        if(is_object($id))
        {
          $id = $id->id;
        }

        $arr = $this->doUpload($files);
        foreach($arr as $entry)
        {
          $entry->projects_id = $id;
          $entry->save();
        }
        return;
    }

    public function updateImage($files, $id)
    {
         $arr = $this->doUpload($files);

         foreach ($arr as $key) {
          $key = array(
            'filename' => $key->filename,
            'original_filename'=> $key->original_filename,
            'mime'=> $key->mime,
            );

          Uploads::where('id', $id)->update($key);
         }
        return;

    }

    public function removeUpload($upload)
    {

      try {

        Uploads::where('original_filename', $upload->original_filename)->delete();

        unlink(public_path('uploads/project/'.$upload->original_filename));
        
        return;

      } catch (Exception $e) {

        throw $e;
      
      }

    }

    public function doUpload($files)
    {
        $file_count = count($files);
        $uploadcount = 0;
          foreach($files as $file) {
            
              $destinationPath = 'uploads/project';
              $filename = $file->getClientOriginalName();

              $filename = $this->renameFile($filename);
              $upload_success = $file->move($destinationPath, $filename);
              
              $uploadcount ++;

              $extension = $file->getClientOriginalExtension();
              $entry = new Uploads();
              $entry->mime = $file->getClientMimeType();
              $entry->original_filename = $filename;
              $entry->filename = $file->getFilename().'.'.$extension;
              
              $entry->way = $this->way();
              $arr[] = $entry;
              
          }
      
        return $arr;
    }


    public function renameFile($filename)
    {
      $file_name_pieces = explode(".",  $filename);
      $length = 20;
      $key = '';
      $keys = array_merge(range(0, 9), range('a', 'z'), range(111, 999));
          for ($i = 0; $i < $length; $i++) 
          {
            $key .= $keys[array_rand($keys)];
          }
      $new_file_name = $key;
      $newname = $new_file_name.'.'.$file_name_pieces[1];

      return $newname;
    }

    public function validateFiles($files)
    {
        foreach($files as $file) {
          $rules = array('file' => 'required|mimes:png,jpeg,jpg'); 
          $validator = Validator::make(array('file'=> $file), $rules);
         return $validator;
        }
    }

}