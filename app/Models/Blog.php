<?php

namespace App\Models;

use Dcat\Admin\Models\Administrator;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function adminuser(){
        return $this->hasOne(Administrator::class,'id','author_id');
    }

    /**
     * A user has and belongs to many roles.
     *
     * @return BelongsToMany
     */
    public function tag(): BelongsToMany
    {
        $pivotTable = BlogTag::class;

        $relatedModel = Tag::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'blog_id', 'tag_id')->withTimestamps();
    }
}
