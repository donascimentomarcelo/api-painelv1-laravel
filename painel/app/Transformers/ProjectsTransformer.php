<?php

namespace Painel\Transformers;

use League\Fractal\TransformerAbstract;
use Painel\Models\Projects;

/**
 * Class ProjectsTransformer
 * @package namespace Painel\Transformers;
 */
class ProjectsTransformer extends TransformerAbstract
{

    /**
     * Transform the \Projects entity
     * @param \Projects $model
     *
     * @return array
     */
    public function transform(Projects $model)
    {
        return [
            'id'         => (int) $model->id,
            'name bla'   => $model->name,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
