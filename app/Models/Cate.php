<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'cate';

    public function blog(){
        return $this->belongsTo(Blog::class,'id','cate_id');
    }
}
