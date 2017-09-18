<?php 

namespace Painel\Services;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Painel\Repositories\PromotionsRepository;
// use Painel\Models\Uploads;
// use Painel\Repositories\UploadsRepository;
/**
* 
*/
class PromotionsService 
{
	private $promotionsRepository;

	
	public function __construct(PromotionsRepository $promotionsRepository)
	{
		$this->promotionsRepository = $promotionsRepository;
	}

	public function saveUpload($files, $id)
	{
		
	}

}
 ?>