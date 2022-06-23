<?php

namespace App\Admin\Repositories;

use App\Models\Blog as BlogModel;
use Dcat\Admin\Repositories\EloquentRepository;

class Blog extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = BlogModel::class;
}
