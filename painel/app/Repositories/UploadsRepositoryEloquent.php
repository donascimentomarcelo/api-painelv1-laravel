<?php

namespace Painel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Painel\Repositories\UploadsRepository;
use Painel\Models\Uploads;
use Painel\Validators\UploadsValidator;

/**
 * Class UploadsRepositoryEloquent
 * @package namespace Painel\Repositories;
 */
class UploadsRepositoryEloquent extends BaseRepository implements UploadsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Uploads::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
