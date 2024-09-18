<?php

namespace App\Admin\Controllers;

use App\Models\Service;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class ServiceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Service';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        // Permission::check('ServiceList');


        $grid = new Grid(new Service());

        $grid->column('id', __('Id'));
        $grid->column('service_name', __('Service name'));
        $grid->column('service_description', __('Service description'));
        $grid->column('service_price', __('Service price'))->display(function($price) {
            return 'Rp ' . number_format($price, 0, ',', '.');
        });        
        $grid->column('slug', __('Slug'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Service::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('service_name', __('Service name'));
        $show->field('service_description', __('Service description'));
        $show->field('service_price', __('Service price'));
        $show->field('slug', __('Slug'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        $form = new Form(new Service());

        $form->text('service_name', __('Service name'));
        $form->text('service_description', __('Service description'));
        $form->text('service_price', __('Service price'));
        
        $form->saving(function (Form $form) {
            $form->model()->slug = Str::slug($form->service_name);
        });

        return $form;
    }    
}
