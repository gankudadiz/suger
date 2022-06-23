<?php

use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use App\Admin\Extensions\Form\WangEditor;
use Dcat\Admin\Form;
use Dcat\Admin\Grid\Filter;
use Dcat\Admin\Show;

/**
 * Dcat-admin - admin builder based on Laravel.
 * @author jqh <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */
//Dcat\Admin\Color::extend('qing', [
//    'primary'        => '#00FFFF',
//    'primary-darker' => '#00FFFF',
//    'link'           => '#00FFFF',
//]);
Dcat\Admin\Color::extend('kelanyin', [
    'primary'        => '#0033FF',
    'primary-darker' => '#0033FF',
    'link'           => '#0033FF',
]);
// 注册前端组件别名
Admin::asset()->alias('@wang-editor', [
    // 为了方便演示效果，这里直接加载CDN链接，实际开发中可以下载到服务器加载
    //'js' => ['https://cdn.jsdelivr.net/npm/wangeditor@4.7.1/dist/wangEditor.min.js'],
    'js' => '/js/wangEditor.min.js',
]);

Form::extend('editor', WangEditor::class);
