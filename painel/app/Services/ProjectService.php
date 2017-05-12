<?php

namespace Painel\Services;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Painel\Models\Uploads;


class ProjectService 
{



	public function save($files, $id)
	{
		return $this->doUpload($files, $id);
	}

	public function doUpload($files, $id)
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
            $entry->projects_id = $id->id;
            $entry->way = $this->way();
            $entry->save();
            
        }
    if($uploadcount == $file_count){

      // return Redirect::to('upload');
        echo '1';
    } 
    else {
      // return Redirect::to('upload')->withInput()->withErrors($validator);
        echo '0';
    }
	}

    public function way()
    {
        return 'uploads/project/';
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
          if($validator->passes()){
            return 1;
          }
          else
          {
            // $validator['info'] = 'Serão aceitas apenas images png, jpeg e jpg!';
            return 0;
          }
        }
    }

}