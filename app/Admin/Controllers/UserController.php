<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;


class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('is_admin', __('Is admin'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('gender', __('Gender'));
        $grid->column('slug', __('Slug'));
        $grid->column('email_verified_at', __('Email verified at'));
        $grid->column('password', __('Password'));
        $grid->column('remember_token', __('Remember token'));
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('is_admin', __('Is admin'));
        $show->field('phone_number', __('Phone number'));
        $show->field('gender', __('Gender'));
        $show->field('slug', __('Slug'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
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
        $form = new Form(new User());

        $form->text('name', __('Name'))->rules('required');
        $form->email('email', __('Email'))->rules('required');
        $form->text('phone_number', __('Phone number'))->rules('required');
        $form->select('gender', __('Gender'))->options(['Male' => 'Male', 'Female' => 'Female'])->rules('required');
        $form->password('password', __('Password'))->rules('required');

        $form->saving(function (Form $form) {
            $form->model()->slug = Str::slug($form->name);
            $form->model()->is_admin = $form->model()->is_admin ?? 0;
        });

        return $form;
    }
}
