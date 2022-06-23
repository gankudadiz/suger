<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Blog;
use App\Models\Cate;
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
        return Grid::make(new Blog(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('cate_id');
            $grid->column('title');
            $grid->column('imgs');
            $grid->column('views');
            $grid->column('author_id');
            $grid->column('is_show');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
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
        return Form::make(new Blog('cate'), function (Form $form) {
//            if ($form->isCreating()) {
                //新增
                $form->display('id');
                $form->select('cate_id','博客分类')->options(Cate::pluck('name','id'))->required();
                $form->text('title','博客标题')->required();
                $form->editor('detail','博客详情');
                $form->image('imgs','封面图')->uniqueName()->autoUpload();
                $form->hidden('views')->value('0');
                $form->hidden('author_id')->value(Auth::guard('admin')->user()->id);
                $states = [
                    'on'  => ['value' => 1, 'text' => '显示', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => '隐藏', 'color' => 'danger'],
                ];
                $form->switch('is_show','是否显示')->options($states);
                $form->display('created_at')->value(date('Y-m-d H:i:s'));
                $form->display('updated_at')->value(date('Y-m-d H:i:s'));
//            }else{
//                //编辑
//            }

        });
    }
}
