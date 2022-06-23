<?php

namespace App\Admin\Repositories;

use App\Models\BlogTag as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class BlogTag extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
