<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'blog';

    public function cate(){
        return $this->hasOne(Cate::class,'id','cate_id');
    }
}
