<?php

namespace Painel\Services;

use Illuminate\Support\Facades\Validator;
use Painel\Models\Uploads;


class ProjectService 
{



	public function save($files, $request)
	{
		// dd($files);
		return $this->doUpload($files, $request);

	}

	public function doUpload($files, $request)
	{
		$file_count = count($files);
        $uploadcount = 0;
        foreach($files as $file) {
          $rules = array('file' => 'required|mimes:png,jpeg,jpg'); 
          $validator = Validator::make(array('file'=> $file), $rules);
          if($validator->passes()){
            $destinationPath = 'uploads/project';
            $filename = $file->getClientOriginalName();
            // $file_name_pieces = explode(".",  $filename);
            // $length = 20;
            // $key = '';
            // $keys = array_merge(range(0, 9), range('a', 'z'));
            //     for ($i = 0; $i < $length; $i++) 
            //     {
            //         $key .= $keys[array_rand($keys)];
            //     }
            // $new_file_name = $key;
            // $newname = $new_file_name.'.'.$file_name_pieces[1];
            $upload_success = $file->move($destinationPath, $filename);
            $uploadcount ++;

            $extension = $file->getClientOriginalExtension();
            $entry = new Uploads();
            $entry->mime = $file->getClientMimeType();
            $entry->original_filename = $filename;
            $entry->filename = $file->getFilename().'.'.$extension;
            $entry->save();
            }
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


}