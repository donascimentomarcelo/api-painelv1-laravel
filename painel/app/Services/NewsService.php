<?php

namespace Painel\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Painel\Models\News;
use Painel\Repositories\NewsRepository;
use Painel\Services\ProjectService;

class NewsService 
{
	private $newsRepository;
	private $projectService;

	public function __construct(NewsRepository $newsRepository, ProjectService $projectService)
	{
		$this->newsRepository = $newsRepository;
		$this->projectService = $projectService;
	}

	public function createNews($request)
	{
		
		$files = Input::file('images');

		if($files[0] != null)
		{
			$returnFiles = $this->doUpload($files);

			foreach ($returnFiles as $entry) 
			{
				$entry->title = $request['title'];
				$entry->description = $request['description'];
				$entry->subject = $request['subject'];
			}

			$entry->save();

			return $entry;
		}
		else
		{
			return $this->newsRepository->create($request);
		}


	}

	public function updateNews($request, $id)
	{
		
		$files = Input::file('images');

		if($files[0] != null)
		{
			$dataFile = $this->newsRepository->find($id);
			
				if(!empty($dataFile['original_filename']))
				{
					$this->destroyImageRepository($dataFile);
				}

			$entrys = $this->doUpload($files);
			
			foreach ($entrys as $entry) {	
				$arr = array(
					'title' =>$request['title'],
					'description' =>$request['description'],
					'subject' =>$request['subject'],
					'mime'=>$entry->mime,
					'original_filename'=>$entry->original_filename,
					'filename'=>$entry->filename,
					'way'=>$entry->way,
					);
			}

			News::where('id', $id)->update($arr);

			return $arr;
		}
		else
		{
			return $this->newsRepository->update($request, $id);
		}
	}

	public function destroyImageRepository($dataFile)
    {
      File::delete('uploads/news/'.$dataFile['original_filename']);

      return;
    }

	public function wayNews()
	{
		return 'http://marceloprogrammer.com/api/uploads/news/';
        // return 'http://localhost:8000/uploads/news/';
	}

	public function doUpload($files)
    {
        $file_count = count($files);
        $uploadcount = 0;
          foreach($files as $file) {
            
              $destinationPath = 'uploads/news';
              $filename = $file->getClientOriginalName();

              $filename = $this->projectService->renameFile($filename);
              $upload_success = $file->move($destinationPath, $filename);
              
              $uploadcount ++;

              $extension = $file->getClientOriginalExtension();
              $entry = new News();
              $entry->mime = $file->getClientMimeType();
              $entry->original_filename = $filename;
              $entry->filename = $file->getFilename().'.'.$extension;
              
              $entry->way = $this->wayNews();

              $arr[] = $entry;
              
          }
      
        return $arr;
    }
}
