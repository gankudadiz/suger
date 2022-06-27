<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Blog;
use App\Models\Cate;
use App\Models\Tag;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Widgets\Markdown;
use Dcat\Admin\Widgets\Card;
use Dcat\Admin\Layout\Content;
use Illuminate\Support\Facades\Auth;
use Dcat\Admin\Http\Controllers\AdminController;

class BlogController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Blog::with(['adminuser','cate','tag']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('cate.name','所属分类');
            $grid->column('tag','博客标签')->pluck('name')->label('primary', 3);
            $grid->column('title')->editable();
            $grid->column('imgs')->image('',100,100);
            $grid->column('views');
            $grid->column('adminuser.username',"作者");
            $grid->column('is_show')->switch('', true);
            $grid->column('created_at')->sortable();
            $grid->showToolbar();
            $grid->quickSearch('title')->placeholder('快速搜索标题...');
//            $grid->filter(function (Grid\Filter $filter) {
//                $filter->panel(); //过滤器在上端。默认为rightside
//                $filter->expand(); //展开过滤器
//                $filter->equal('id')->width(3);
//            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Blog(), function (Show $show) {
            $show->field('id');
            $show->field('cate_id');
            $show->field('title');
            $show->field('detail');
            $show->field('imgs');
            $show->field('views');
            $show->field('author_id');
            $show->field('is_show');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(Blog::with(['cate','tag']), function (Form $form) {
//            if ($form->isCreating()) {
                //新增
                $form->display('id');
                $form->select('cate_id','博客分类')->options(Cate::pluck('name','id'))->required();
                $form->text('title','博客标题')->required();
                $form->editor('detail','博客详情');
                $form->multipleSelect('tag','博客标签')
                ->options(function () {
                    $tagModel = Tag::class;
                    return $tagModel::all()->pluck('name', 'id');
                })
                ->customFormat(function ($v) {
                    return array_column($v, 'id');
                });
                $form->image('imgs','封面图')->uniqueName()->autoUpload();
                $form->hidden('views')->value('0');
                $form->hidden('author_id')->value(Auth::guard('admin')->user()->id);
                $status = [
                    'on'  => ['value' => 1, 'text' => '显示', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => '隐藏', 'color' => 'danger'],
                ];
                $form->switch('is_show','是否显示')->options($status);
                $form->display('created_at')->value(date('Y-m-d H:i:s'));
                $form->display('updated_at')->value(date('Y-m-d H:i:s'));
//            }else{
//                //编辑
//            }

        });
    }
}
