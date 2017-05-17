<?php

namespace Painel\Repositories;

use Painel\Models\Projects;
use Painel\Presenters\ProjectsPresenter;
use Painel\Repositories\ProjectsRepository;
use Painel\Validators\ProjectsValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ProjectsRepositoryEloquent
 * @package namespace Painel\Repositories;
 */
class ProjectsRepositoryEloquent extends BaseRepository implements ProjectsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Projects::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function presenter()
    {
        return \Painel\Presenters\ProjectsPresenter::class;
    }
}
