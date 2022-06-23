<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'blog_tag';
    
}
