<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\BlogTag;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class BlogTagController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new BlogTag(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('blog_id');
            $grid->column('tag_id');
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
        return Show::make($id, new BlogTag(), function (Show $show) {
            $show->field('id');
            $show->field('blog_id');
            $show->field('tag_id');
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
        return Form::make(new BlogTag(), function (Form $form) {
            $form->display('id');
            $form->text('blog_id');
            $form->text('tag_id');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
