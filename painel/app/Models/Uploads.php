<?php

namespace Painel\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Uploads extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
    			'filename',
    			'way',
    			'mime',
    			'original_filename',
    			'projects_id'
    			];

    public function project()
    {
    	return $this->hasMany(Projects::class, 'id', 'projects_id');
    }

}
